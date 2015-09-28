__author__ = 'audreymccormick'

from webargs.flaskparser import FlaskParser

from flask import Flask
from flask.ext.sqlalchemy import SQLAlchemy

from itsdangerous import URLSafeSerializer
from flask.ext.script import Manager
from flask.ext.migrate import Migrate, MigrateCommand

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:banana@localhost:3306/aphelion'
app.secret_key = 'bananaANKLEfoot'
db = SQLAlchemy(app)

parser = FlaskParser()

encryptor = URLSafeSerializer(app.secret_key, salt='022015')

def dbadd(item):
    db.session.add(item)
    db.session.commit()

if __name__ == '__main__':

    migrate = Migrate(app, db)

    manager = Manager(app)
    manager.add_command('db', MigrateCommand)
    manager.run()