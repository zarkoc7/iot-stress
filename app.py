import serial
import requests
import sys

pp=serial.Serial('/dev/ttyACM0',9600) #konekcija sa Arduino serijskim monitorom

url1 = 'http://192.168.0.40:80/projekatApp/get_cookie.php'
if not sys.argv[1] or not sys.argv[2]:
  print("Please provide both username and password as arguments!")
  sys.exit()
username = sys.argv[1]
password = sys.argv[2]



# r = requests.Session()
# print(username, password)
myobj1 = {"username": username, "password": password}
res = requests.post(url1, json = myobj1)

cookies2 = res.cookies
# for cookie in cookies2:
#   print(cookie.name, cookie.value)
if not res.status_code or res.status_code!=200:
  print("Invalid credentials!")
  sys.exit()


while True: 
  # print(pp.readline()) #citanje vrednosti sa monitora
  vrednost=pp.readline()
  procitana=vrednost.decode('utf-8')
  
  if(procitana.split(":")[0]=="P"):
    print ("Vrednost pulsa:  ", procitana.split(":")[1] ) #stampanje prve vrednosti - pulsa
    url2 = 'http://192.168.0.40:80/projekatApp/post_data.php'
    myobj = {"pulse": int(procitana.split(":")[1])} 
    res = requests.post(url2, json = myobj, cookies = cookies2)
    print(res.text)
   
  if(procitana.split(":")[0]=="G"):
    print ("Vrednost gsr:  ",procitana.split(":")[1] ) #stampanje prve vrednosti - pulsa
    url2 = 'http://192.168.0.40:80/projekatApp/post_data_gsr.php'
    myobj = {"gsr": int(procitana.split(":")[1])} 
    res = requests.post(url2, json = myobj, cookies = cookies2)
    print(res.text)
  


  

  
  
