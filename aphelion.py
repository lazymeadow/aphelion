import sys
import os
import traceback

from flask import Flask, render_template, send_from_directory

app = Flask(__name__)


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


@app.errorhandler(500)
def errorstuff(error):
    print traceback.print_tb(sys.exc_traceback)
    return 'ERROR:' + str(error.message) + str(traceback.format_tb(sys.exc_traceback))


if __name__ == '__main__':
    app.jinja_env.filters['content_title_filter'] = content_title_filter
    app.run()
