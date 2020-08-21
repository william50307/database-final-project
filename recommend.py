import sys, json
import math
import random
import datetime
path =['c:\\xampp\\htdocs\\db\\DBMS1', 'C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python37-32\\python37.zip', 'C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python37-32\\DLLs', 'C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python37-32\\lib', 'C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python37-32', 'C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python37-32\\lib\\site-packages']
for p in path:
    sys.path.append(p)
import pymysql
import io
import urllib.parse
 
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
#data = urllib.parse.unquote('data')
#assign eacch object into cloest centroids
def grooups_init(data, centroids):
    groups = []
    for i in range(0, len(data)):
        temp = get_dis_to_everycentroids(data, i, centroids)
        new_group = temp.index(min(temp))
        groups.append(new_group)
    return groups

#compute two-point distance in n dimensions
#return a list which contains the distance of one data to every centroids
def get_dis_to_everycentroids(data, index, centroids):
    dis_list = []   #store the distance of one object to every centroids
    for i in range(0, len(centroids)):
        dis = 0
        for j in range(0, len(centroids[0])):
            dis += (data[index][j] - centroids[i][j])** 2   #use Euclidean distance
        dis_list.append(math.sqrt(dis))
    return dis_list    

#get random-assigned centroids
def get_centroids(k, dimension, data):
    temp = []
    #find the max vlaue in this dataset
    for i in range(len(data)):
        temp.append(max(data[i]))
    max_num = max(temp)
    row= [] 
    for i in range(0, k):
        col = []
        for j in range(0, dimension):         
            col.append(random.random()*max_num)
        row.append(col)
    return row 

#assign each object into the cloest centroid
def assign(data, centroids, groups):
    for i in range(0, len(data)):
        temp = get_dis_to_everycentroids(data, i, centroids)
        new_group = temp.index(min(temp))
        groups[i] = new_group

#print SSE
def print_total_dis(groups, data, centroids):
    total_dis = 0
    for i in range(0, len(groups)):
        for k in range(0, len(centroids[0])):
            total_dis += (data[i][k] - centroids[groups[i]][k])** 2
    #print(total_dis)
    return total_dis

#compute where is the new centroids
def centroids_reassign(groups, centroids, data):
    k_num = len(centroids)
    data_num = len(data)
    dimension = len(data[0])

    for i in range(0, k_num):                        
        for j in range(0, dimension):
            count = 0
            temp = 0
            for k in range(0, data_num):     #第K筆資料
                if groups[k] == i:
                    temp += data[k][j]
                    count += 1
            if count == 0:
                g = random.randint(0, data_num-1)
                groups[g] = i
                for y in range(0, dimension):
                    centroids[i][y] = data[g][y]
            else:    
                centroids[i][j] = temp / count

#main function
def kmeans(data, k, iterate,sse):
    data_num = len(data)
    dimension = len(data[0])

    #initial step
    centroids = get_centroids(k, dimension, data)  #get random centroids
    groups = grooups_init(data,centroids)   #assign each object into closest centroid
    #iterate
    for i in range(0, iterate):
        centroids_reassign(groups, centroids, data) #compute where is the new centroids
        assign(data, centroids, groups)  #assign each object into the cloest centroid

    sse.append(print_total_dis(groups, data, centroids))
    #print("final group:", groups)
    return groups

conn = pymysql.Connect(host = '127.0.0.1',
                        port = 3306,
                        user = 'root',
                        passwd = '',
                        db = 'xprice',
                        charset='utf8')
cursor = conn.cursor()
#取出所有類別
cate = '''SELECT DISTINCT m_cate FROM product,store,supplyed WHERE product.pno = supplyed.pno AND
           supplyed.sid = store.sid AND store.sid = 1'''
cursor.execute(cate)
results = cursor.fetchall()
cates = [] #存放所有類別，連接成字串
for cate in results:
    cate = "sum("+cate[0]+")/count(keyword)"
    cates.append(cate)
attrs = ",".join(cates)
#取得每個消費者特徵
sql = "SELECT member.mid,"+attrs+'''FROM keyword,search,member
    WHERE keyword.keyword_id = search.keyword_id AND member.mid = search.mid
    GROUP BY member.mid '''
cursor.execute(sql)
results = cursor.fetchall()
#過濾資料
data = []
for row in results:
    temp = row[1:]
    data.append(temp)
#不同k值的SSE (k=1~10)
sse = []
for i in range(1, 11):
    kmeans(data, i, 30, sse)
k = sse.index(min(sse)) + 1 #共分幾群
k_groups = kmeans(data, k, 30, sse)

mid = 0   #目前登入的會員id 
mids = [] #取得所有會員ID
for item in results:
    mids.append(item[0])

if mid in mids:
    k = k_groups[mids.index(mid)]  #找出該mid被分在第幾群
    indexs = [i for i, j in enumerate(k_groups) if j == k]  #被分在同一群的會員的index

    if (len(indexs) == 1):#該群只有自己一個，從歷史紀錄推薦
        keywords = []
        sql = '''SELECT keyword FROM keyword,search,member 
                WHERE keyword.keyword_id = search.keyword_id AND 
                search.mid = member.mid AND member.mid = {} '''.format(mid)
        cursor.execute(sql)
        results = cursor.fetchall()
        
        for item in results:
            keywords.append(item[0])
        print(random.choice(keywords)) 
    else:
        midlist = ["member.mid="+str(results[i][0]) for i in indexs if results[i][0] != mid]
        tosqlstring = " OR ".join(midlist)
        tosqlstring='('+tosqlstring+')'
        sql = '''SELECT keyword.keyword 
                FROM keyword,search,member 
                WHERE keyword.keyword_id = search.keyword_id AND 
                search.mid = member.mid AND {} AND 
                keyword.keyword_id not in(SELECT keyword.keyword_id
                            FROM keyword,search,member
                            WHERE keyword.keyword_id = search.keyword_id AND search.mid = member.mid AND
                            member.mid = {}) '''.format(tosqlstring,mid)
        cursor.execute(sql)
        results = cursor.fetchall()

        if (len(results) == 0):     #自己的搜尋紀錄-其他人搜尋紀錄 = 空集合 
            keywords = []
            sql = '''SELECT keyword FROM keyowrd,search,member 
                WHERE keyword.keyword_id = search.keyword_id AND 
                search.mid = member.mid AND mid = {} '''.format(mid)
            cursor.execute(sql)
            results = cursor.fetchall()
            for item in results:
                keywords.append(item[0])
            print(random.choice(keywords))     
        else:   # random return one keyword 
            keywords = []
            for item in results:
                keywords.append(item[0])
            print(random.choice(keywords))

else:  #如果會員id不在list裡面則代表沒有搜尋紀錄,選出目前最熱門的商品
    sql = '''SELECT count(search.mid)
            FROM search,member,keyword
            WHERE search.mid = member.mid AND search.keyword_id = keyword.keyword_id
            GROUP BY keyword.keyword_id
            HAVING count(search.mid)>= ALL(SELECT count(search.mid)
                                        FROM search,member,keyword
                                        WHERE search.mid = member.mid AND search.keyword_id = keyword.keyword_id
                                        GROUP BY keyword.keyword_id)'''
    cursor.execute(sql)
    results = cursor.fetchall()
    print(results[0][0])