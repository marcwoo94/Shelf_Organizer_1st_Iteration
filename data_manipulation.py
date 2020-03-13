# -*- coding:utf-8 -*-
from collections import OrderedDict
import csv
import json

f_read = open('C:\\Users\\user\\Desktop\\songdolib_200225.csv', 'r', encoding='utf-8')
f_read_csv = csv.reader(f_read)

booklist = [line for line in f_read_csv]

def get_booklist(i):
    id_num = booklist[i][0].strip()
    regi_num = booklist[i][1].strip()
    library_code = booklist[i][2].strip().split(' ')[0]
    category = booklist[i][2].strip().split(' ')[-1].split('-')[0]
    call_num = booklist[i][2].strip().split(' ')[-1]
    title = booklist[i][3].strip()
    author = booklist[i][4].strip()
    publisher = booklist[i][5].strip()
    year_of_pub = booklist[i][6].strip()
    price = booklist[i][7].strip()
    ISBN = booklist[i][8].strip()
    checked_out = booklist[i][9].strip()

    dictionary1 = OrderedDict()
    dictionary1['id'] = id_num
    dictionary1['regi_num'] = regi_num
    dictionary1['library_code'] = library_code
    dictionary1['category'] = category
    dictionary1['call_num'] = call_num
    dictionary1['title'] = title
    dictionary1['author'] = author
    dictionary1['publisher'] = publisher
    dictionary1['year_of_pub'] = year_of_pub
    dictionary1['price'] = price
    dictionary1['ISBN'] = ISBN
    dictionary1['checked_out'] = checked_out

    return dictionary1


def get_booklist_by_dictionary():
    booklist_dictionary = [get_booklist(i) for i in range(0, len(booklist))]
    return booklist_dictionary

print(json.dumps(get_booklist_by_dictionary(), ensure_ascii=False, indent='\t'))

with open('C:\\Users\\user\\Desktop\\songdolib_200225.json', 'w', encoding='utf-8') as make_file:
    json.dump(get_booklist_by_dictionary(), make_file, ensure_ascii=False, indent='\t')

f_read.close()
