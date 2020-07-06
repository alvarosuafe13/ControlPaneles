import pymysql
import json
from hashlib import md5

class DataBase:
	
	def __init__(self):
		self.connection = pymysql.connect(
			#host="192.168.181.1",
			host="34.70.183.119",
			user="u716496248_alvar",
			db="u716496248_alvar",
			password="alvaro"
		)

		self.cursor = self.connection.cursor()

		print("conexión")



	def guardarAdmin(self, admin, password, evento):
		sql = "SELECT * FROM ADMIN WHERE codEvento = %s"

		try:
			self.cursor.execute(sql,(evento))


			if(self.cursor.fetchone()):
				sql = "UPDATE ADMIN SET nombreAdmin = %s, contraAdmin = %s WHERE codEvento = %s "

				try:
					self.cursor.execute(sql,(admin, password, evento))
					self.connection.commit()
				except Exception as e:
					raise


			else:

				sql = "INSERT INTO ADMIN (nombreAdmin, contraAdmin, codEvento) VALUES (%s, %s, %s) "

				try:
					self.cursor.execute(sql,(admin, password, evento))
					self.connection.commit()
				except Exception as e:
					raise	

		except Exception as e:
			raise



class Admin:

	def __init__(self):
		self.admin = " "
		self.passwordMd5 = " "
		self.codEvento = " "


	def obtener_info_equipo(self):
	    try:
	        with open('/home/pi/Pantalla/evento.json', 'r') as f:
	            info = json.load(f)
	        return info

	    except IOError:
	        print("No se ha podido abrir el archivo")
	        sys.exit()


	def codificarMd5(self):
	 	datos_raspberry = self.obtener_info_equipo()
	 	pasword = datos_raspberry['ContraAdmin']

	 	paswordMd5 = md5(pasword.encode("UTF-8")).hexdigest()

	 	self.passwordMd5 = paswordMd5

	def obtenerNombreAdmin(self):
	 	datos_raspberry = self.obtener_info_equipo()
	 	admin = datos_raspberry['NobreAdmin']
	 	self.admin = admin


	def obtenerCodeEvento(self):
	 	datos_raspberry = self.obtener_info_equipo()
	 	evento = datos_raspberry['CodEvento']
	 	self.codEvento = evento



if __name__ == "__main__":
	database = DataBase()
	adminEvento = Admin()


	adminEvento.obtenerNombreAdmin()
	adminEvento.codificarMd5()
	adminEvento.obtenerCodeEvento()

	print(adminEvento.admin)
	print(adminEvento.passwordMd5)
	print(adminEvento.codEvento)

	if(len(adminEvento.admin) < 15):
		database.guardarAdmin(adminEvento.admin, adminEvento.passwordMd5, adminEvento.codEvento)
