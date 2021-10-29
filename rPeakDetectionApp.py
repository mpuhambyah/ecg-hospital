import csv
import tkinter as tk
from tkinter.filedialog import askopenfilename
import pandas as pd
from biosppy import storage
from biosppy.signals import ecg

import os

global directory

directory = r'C:/Users/mpuha/Downloads/'

def importCsv():
    global textPath
    global csv_file_path
    global textState
    csv_file_path = askopenfilename()
    textPath.set(csv_file_path)
    textState.set("File is ready")

   
def rpeakDetect():
    data = pd.read_csv(csv_file_path, sep=";")
    filename = csv_file_path.split('/')
    npdata = data.values
    datatime = npdata[:, 0]
    dataecg = npdata[:, 1]
    out = ecg.ecg(signal=dataecg, sampling_rate=200., show=True)
    result = []
    for x in out[2]:
        temp = str(x) + ";" + str(datatime[x]) + ";" + str(dataecg[x])
        result.append(temp)
    print(result)
    with open(directory + 'rpeak_' + filename[-1], 'w', newline='') as file:
        file.write('sample;timestamp;ii\n')
        mywriter = csv.writer(file, delimiter=",")
        mywriter.writerows(map(lambda x: [x], result))
    textState.set("Success")
    
def openFolder():
    path = directory
    path = os.path.realpath(path)
    os.startfile(path)

        

root = tk.Tk()
tk.Label(root, text='File Path').grid(row=0, column=0)
textPath = tk.StringVar()
textState = tk.StringVar()
entry = tk.Entry(root, textvariable=textPath).grid(row=0, column=1)
entry2 = tk.Entry(root, textvariable=textState).grid(row=1, column=1)
tk.Button(root, text='Browse',command=importCsv, width=15).grid(row=0, column=3,  padx=(10, 0))
tk.Button(root, text='Deteksi R Peak',command=rpeakDetect, width=15).grid(row=1, column=3,  padx=(10, 0),  pady=(10, 10))
tk.Button(root, text='Open Folder',command=openFolder, width=15).grid(row=2, column=3,  padx=(10, 0),  pady=(0, 10))
tk.Button(root, text='Close',command=root.destroy, width=15).grid(row=3, column=3,  padx=(10, 0))
root.mainloop()