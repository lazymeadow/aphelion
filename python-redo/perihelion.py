import sys
import os
import traceback

from flask import render_template, send_from_directory, request, redirect, flash
from flask.ext.login import LoginManager, UserMixin, login_user, current_user, login_required, logout_user

from webargs import fields

from lib import parser, dbadd, app, db, encryptor
from models.users import Person


login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = 'login'


class User(UserMixin):
    def __init__(self, username):
        self.person = db.session.query(Person).filter(Person.username == username).first()

    def get_id(self):
        return self.person.username

    @staticmethod
    def get(user_id):
        return User(db.session.query(Person).filter(Person.username == user_id).first().username)


def validate_user(username, password):
    try:
        print username, password
        user = User.get(username)
        if encryptor.loads(user.person.password) == password:
            print 'valid user'
            return True
        print 'invalid user'
        return False
    except Exception as e:
        traceback.print_exc(sys.exc_traceback)


@login_manager.user_loader
def load_user(user_id):
    return User.get(user_id)

@app.route("/logout")
@login_required
def logout():
    logout_user()
    return redirect('/')


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
    print current_user.is_authenticated()
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
    if current_user.is_authenticated():
        return redirect('/')
    if request.method == 'POST':
        print 'post'
        args = {'username': fields.Str(required=True),
                'password': fields.Str(required=True)}
        args = parser.parse(args, request)
        print args
        if validate_user(args['username'], args['password']):
            login_user(User.get(args['username']))
            return redirect('/')
        else:
            return render_template('login.html', error='Login failed')
    if request.method == 'GET':
        return render_template('login.html')


@app.route('/register', methods=['GET'])
def register():
    return render_template('register.html')


@app.route('/register', methods=['POST'])
def create_user():
    def validate_email(email):
        return (len(email.split('@')) == 2) and (len(email.split('.')) >= 2)

    args = {"name": fields.Str(required=True),
            "username": fields.Str(required=True),
            "pass1": fields.Str(required=True),
            "pass2": fields.Str(required=True),
            "email": fields.Str(required=True, validate=validate_email)}

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
    app.run(host='0.0.0.0', port=7500) # , use_reloader=True)
