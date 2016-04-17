__author__ = 'audreymccormick'

from lib import db


class Person(db.Model):
    username = db.Column(db.String(64), primary_key=True)
    name = db.Column(db.String(256))
    password = db.Column(db.String(256))
    email = db.Column(db.String(256), nullable=False)
    permission_level = db.Column(db.Integer, default=0)
    avatar = db.Column(db.String(64))


class File(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    path = db.Column(db.String(128), nullable=False)
    type = db.Column(db.String(128), nullable=False)


class ForumCategory(db.Model):
    name = db.Column(db.String(128), nullable=False, primary_key=True)
    description = db.Column(db.String(256), nullable=False)


class ForumPost(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    content = db.Column(db.Text, nullable=False)
    date = db.Column(db.DateTime)
    topic = db.Column(db.Integer, db.ForeignKey('forum_topic.id'))
    author = db.Column(db.String(64), db.ForeignKey('person.username'))


class ForumTopic(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    subject = db.Column(db.String(256), nullable=False)
    date = db.Column(db.DateTime)
    category = db.Column(db.String(128), db.ForeignKey('forum_category.name'))
    author = db.Column(db.String(64), db.ForeignKey('person.username'))
