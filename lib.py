__author__ = 'audreymccormick'

from flask.ext.sqlalchemy import SQLAlchemy

from aphelion import app

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:banana@localhost:3306/aphelion'
db = SQLAlchemy(app)

def dbadd(item):
    db.session.add(item)
    db.commit()


