import os

from flask import Flask, render_template, url_for, send_from_directory

app = Flask(__name__)


@app.route('/favicon.ico')
def favicon():
    return send_from_directory(os.path.join(app.root_path, 'static'),
                               'favicon.ico')


@app.route('/')
def index():
    return render_template('index.html', page='index')


@app.route('/features')
def features():
    for _, _, files in os.walk(os.path.join(app.root_path, 'static/content/features/')):
        pass
# loop
    return render_template('features.html', page='features', paths=files)


@app.errorhandler(500)
def errorstuff(error):
    print error.message
    return error.message


if __name__ == '__main__':
    app.run()
