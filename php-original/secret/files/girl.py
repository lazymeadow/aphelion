from direct.showbase.ShowBase import ShowBase
from direct.actor.Actor import Actor

class MyApp(ShowBase):
	
	def __init__(self):
		ShowBase.__init__(self)
		self.girl = self.loader.loadModel("girl4.egg")
		self.player = Actor(self.girl, {"walk": "girl4-walk"})
		self.player.setPos(0, 5, -1)
		self.player.reparentTo(self.render)
		self.player.loop("walk")

app = MyApp()
app.run()