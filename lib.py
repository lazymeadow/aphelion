__author__ = 'audreymccormick'

from webargs.flaskparser import FlaskParser

from flask import Flask
from flask.ext.sqlalchemy import SQLAlchemy

from itsdangerous import URLSafeSerializer


app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:banana@localhost:3306/aphelion'
app.secret_key = 'bananaANKLEfoot'
db = SQLAlchemy(app)

parser = FlaskParser()

encryptor = URLSafeSerializer(app.secret_key, salt='022015')

def dbadd(item):
    db.session.add(item)
    db.session.commit()

