__author__ = 'audreymccormick'

from aphelion import db

class User(db.Model):
    username = db.Column(db.String(64), primary_key=True)
    name = db.Column(db.String(256))
    password = db.Column(db.String(256))
