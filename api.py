from concurrent.futures import ThreadPoolExecutor
from tornado.concurrent import run_on_executor
import tornado.httpserver
import tornado.ioloop
import tornado.options
import tornado.web
import tornado.gen
import json
import traceback
import comparison
import audio

class MainHandler(tornado.web.RequestHandler):
    executor = ThreadPoolExecutor(32)
    @tornado.gen.coroutine
    def post(self):

        audioPath = self.get_argument("audioPath", None)
        filename = self.get_argument("filename", None)
        head_url = self.get_argument("head_url", '')
        img_url = self.get_argument("img_url", '')
        yield self.coreOperation(head_url, img_url,audioPath,filename)

    @run_on_executor
    def coreOperation(self, head_url, img_url,audioPath,filename):
        try:

            if  head_url != '' and img_url != '':
                result = comparison.saveImg(head_url,img_url)
                print(result)
                if result:
                    result = json.dumps({'code': 200, 'result': result, })
                else:
                    result = json.dumps({'code': 210, 'result': 'no result',})
            elif audioPath != '' and filename != '':
                result = audio.audioConvert(audioPath,filename)
                print(result)
                if result:
                    result = json.dumps({'code': 200, 'result': result, })
                else:
                    result = json.dumps({'code': 210, 'result': 'no result',})
            else:
                result = json.dumps({'code': 211, 'result': 'wrong input a or b', })
            self.write(result)
        except Exception:
            print ('traceback.format_exc():\n%s' % traceback.format_exc())
            result = json.dumps({'code': 503,'result': str(a)+'+'+str(b)})
            self.write(result)


if __name__ == "__main__":

    tornado.options.parse_command_line()
    app = tornado.web.Application(handlers=[(r'/file_handling/post', MainHandler)], autoreload=False, debug=False)
    http_server = tornado.httpserver.HTTPServer(app)
    http_server.listen(8832)
    tornado.ioloop.IOLoop.instance().start()