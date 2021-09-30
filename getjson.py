import tkinter as tk
from tkinter import ttk

import pandas as pd
import csv

from urllib.request import urlopen

class App():
    def __init__(self, parent):
        nama = []
        self.parent = parent
        self.parent.title("Test")
        self.parent.iconphoto(False, tk.PhotoImage(file="./logo.png"))
        with open ('pasien.txt', 'r') as f:
            reader = csv.reader(f)
            for row in reader:
                nama.append(row[3])
            if(len(nama) > 0):
                nama.pop(0)
        self.options = nama

        self.om_variable = tk.StringVar(self.parent)
        self.om_variable.set('Pilih Pasien')
        self.om_variable.trace('w', self.option_select)
        if(len(nama) > 0):
            self.om = tk.OptionMenu(self.parent, self.om_variable, *self.options)
        else:
            self.om = tk.OptionMenu(self.parent, self.om_variable, self.options)
        self.om.grid(column=0, row=0)

        self.button = tk.Button(self.parent, text='Update Pasien', command=self.add_option)

        self.button.grid(column=1, row=0)

      

    def add_option(self):
        nama = []
        df = pd.read_json('http://localhost/ecg-hospital/data/alatGetDataPasien/c4ca4238a0b923820dcc509a6f75849b')
        df.to_csv (r'pasien.txt', index = False)
        with open ('pasien.txt', 'r') as f:
            reader = csv.reader(f)
            for row in reader:
                nama.append(row[3])
            if(len(nama) > 0):
                nama.pop(0)
        self.options.clear()
        for i in nama:
            self.options.append(i)
        
        menu = self.om["menu"]
        menu.delete(0, "end")
        for string in self.options:
            menu.add_command(label=string, 
                             command=lambda value=string: self.om_variable.set(value))
        print(self.options)

    def option_select(self, *args):
        print(self.om_variable.get())


root = tk.Tk()
App(root)
root.mainloop()