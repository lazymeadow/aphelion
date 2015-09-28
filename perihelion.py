import sys
import os
import traceback

from flask import render_template, send_from_directory, request, redirect
from flask.ext.script import Manager
from flask.ext.migrate import Migrate, MigrateCommand
from flask.ext.login import LoginManager, UserMixin, login_user

from webargs import Arg

from lib import parser, dbadd, app, db, encryptor
from models.users import Person


migrate = Migrate(app, db)

manager = Manager(app)
manager.add_command('db', MigrateCommand)

login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = 'login'


class User(UserMixin):
    authenticated = False
    def __init__(self, username):
        self.person = db.session.get(Person).where(Person.username == username).first()

    def is_authenticated(self):
        return self.authenticated

    def get_id(self):
        return self.person.username

    @staticmethod
    def get(user_id):
        return User(db.session.get(Person).where(Person.username == user_id).first().username)


def validate_user(username, password):
    user = User.get(username)
    if encryptor.loads(user.person.password) == password:
        return True
    return False


@login_manager.user_loader
def load_user(user_id):
    return User.get(user_id)


def get_content(rel_path):
    paths = []
    for _, _, files in os.walk(os.path.join(app.root_path, 'templates/content/{}/'.format(rel_path))):
        for file in files:
            paths.append('content/{}/{}'.format(rel_path, file))
    return paths


def get_images(rel_path):
    paths = []
    for _, _, images in os.walk(os.path.join(app.root_path, 'static/images/{}'.format(rel_path))):
        for image in images:
            paths.append('static/images/{}/{}'.format(rel_path, image))
    return paths


def content_title_filter(string):
    return string.split('/')[-1].replace('_', ' ')[:-5].title()


@app.route('/favicon.ico')
def favicon():
    return send_from_directory(os.path.join(app.root_path, 'static'),
                               'favicon.ico')


@app.route('/')
def index():
    return render_template('index.html', page='index')


@app.route('/features')
def features():
    return render_template('content.html', page='features', paths=get_content('features'))


@app.route('/universe')
def universe():
    return render_template('content.html', page='universe', paths=get_content('universe'))


@app.route('/art')
def art():
    return render_template('gallery.html', page='art', imgs=get_images('gallery'), thumbs=get_images('thumbs'))


@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method is 'POST':
        args = {'username': Arg(str, required=True),
                'password': Arg(str, required=True)}
        args = parser.parse(args, request)
        if validate_user(args['username'], args['password']):
            login_user(User.get(args['username']))
    return render_template('login.html')


@app.route('/register', methods=['GET'])
def register():
    return render_template('register.html')


@app.route('/register', methods=['POST'])
def create_user():
    def validate_email(email):
        return (len(email.split('@')) == 2) and (len(email.split('.')) >= 2)

    args = {"name": Arg(str, required=True),
            "username": Arg(str, required=True),
            "pass1": Arg(str, required=True),
            "pass2": Arg(str, required=True),
            "email": Arg(str, required=True, validate=validate_email)}

    args = parser.parse(args, request, validate=lambda args: args['pass1'] == args['pass2'])

    new_user = Person()
    new_user.name = args['name']
    new_user.username = args['username']
    print args['pass1']
    new_user.password = encryptor.dumps(args['pass1'])
    print new_user.password
    new_user.email = args['email']
    new_user.avatar = None

    dbadd(new_user)
    return redirect('/login')


@app.errorhandler(500)
def errorstuff(error):
    print traceback.print_tb(sys.exc_traceback)
    return 'ERROR:' + str(error.message) + str(traceback.format_tb(sys.exc_traceback))


if __name__ == '__main__':
    app.jinja_env.filters['content_title_filter'] = content_title_filter
    # app.run()
    manager.run()
