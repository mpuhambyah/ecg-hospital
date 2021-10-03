import csv
import json
from typing import Counter
import requests
import json
 
 
def make_json(csvFilePath, jsonFilePath):
     
    data = {}
    count = 0
     
    with open(csvFilePath, encoding='utf-8') as csvf:
        csvReader = csv.DictReader(csvf, delimiter=',')
         
        for rows in csvReader:
             
            key = count
            data[key] = rows
            count += 1
 
    with open(jsonFilePath, 'w', encoding='utf-8') as jsonf:
        jsonf.write(json.dumps(data, indent=4))
    
    result = json.dumps(data, indent=4)
    return result
        
         
 
csvFilePath = r'samples.csv'
jsonFilePath = r'test.json'
 
result = make_json(csvFilePath, jsonFilePath)

# url = 'http://localhost/ecg-hospital/Data/apiGetData/5/c4ca4238a0b923820dcc509a6f75849b'
url = 'http://alive.b401telematics.com/Data/apiGetData/3/c4ca4238a0b923820dcc509a6f75849b'

headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}
r = requests.post(url, data=result, headers=headers, verify=False)

print(r.text)