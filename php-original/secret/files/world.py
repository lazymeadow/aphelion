from direct.showbase.ShowBase import ShowBase
from panda3d.core import GeoMipTerrain
from direct.actor.Actor import Actor

class MyApp(ShowBase):
	
	def __init__(self):
		ShowBase.__init__(self)
		
		
		#standard GeoMipTerrain usage
		self.terrain = GeoMipTerrain("worldTerrain")
		self.terrain.setHeightfield("mapheight.png")
		self.terrain.setColorMap("maptexture.png")
		#self.terrain.setBruteforce(True)
		#set dynamically updated terrain
		self.terrain.setBlockSize(32)
		self.terrain.setNearFar(128, 256) #distance in terrain coordinates
		self.terrain.setMinLevel(0) #low means high quality
		self.terrain.setFocalPoint(base.camera) #a NodePath
		#get root
		root = self.terrain.getRoot()
		root.reparentTo(render)
		root.setSz(100)
		self.terrain.generate()
		taskMgr.add(self.updateTask,  "update")
		
		self.camera.setPos(0, 0, 0)
		
		#add person
		self.player = Actor("girl4.x", {"girl03_03": "girl"})
		print("girl loaded")
		self.player.setPos(0, 5, -1)
		self.player.reparentTo(self.render)
		print("girl reparented")
	
	def updateTask(self, task):
		self.terrain.update()
		return task.cont
	
		
app = MyApp()
app.run()