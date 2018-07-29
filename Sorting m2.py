
# coding: utf-8


import pandas as pd
import numpy as np


from random import shuffle
from itertools import chain, islice
import math
from datetime import datetime



# df = pd.DataFrame(User data imported from app database)

dicdf = pd.read_excel('...MBTI Dictionary.xlsx', 'Sheet1')


matchingdict = {}
for line in (dicdf.values.tolist()):
    matchingdict[line[0]] = line[1:]


def nCr(n,r):
    f = math.factorial
    return f(n) / f(r) / f(n-r)




variable_to_be_diversified = 'Country'
totalvariable = len(set(df[variable_to_be_diversified]))
groupsize = 20
mbticombis = nCr(groupsize,2)
def getscore(x):
    totalmatch = 0
    for i, person in x.iterrows():
        individualmatch = 0
        for j, otherpeople in x.drop(i).iterrows():
            if otherpeople['Personality'] in matchingdict[person['Personality']]:
                individualmatch += 1
        totalmatch += individualmatch
        
    '''This is a composite score designed to compare different outcomes, outcomes with better matching of personality 
    and better diversified variable_to_be_diversified will be preferred'''
    scorefromdiversity = len(set(x[variable_to_be_diversified]))/totalvariable
    scorefrommatching = totalmatch/2/mbticombis
    score = (scorefromdiversity + scorefrommatching)/2*100
    
    return score, scorefromdiversity
    



# The first solution is a randomised process that keeps trying to find solutions that returns a higher composite index.

bestconfig = None
bestscore = 0
trackscore = []
listofindex = df.index.tolist()

for roun in range(3):
    if roun == 0:
        time = datetime.now()
    print(roun, end = '\r')
    shuffle(listofindex)
    groupingoverall = []
    for i in range(len(listofindex)//groupsize+1):
        groupingoverall.append(listofindex[i*groupsize:(i+1)*groupsize])
    individualscore = [getscore(df[df.index.isin(groupingoverall[i])])[0] for i in range(len(groupingoverall))]
    individualscorefromdiversity = [getscore(df[df.index.isin(groupingoverall[i])])[1] for i in range(len(groupingoverall))]
    score = np.mean(individualscore) - np.var(individualscorefromdiversity)
    if score>bestscore:
        bestscore = score
        bestconfig = [g for g in groupingoverall if len(g)>0]
    trackscore.append(bestscore)

    
print('Time Taken to Run Randomised Optimisation: ', ((datetime.now()-time).seconds)/60)



ax = pd.DataFrame(data = trackscore ).plot(title = 'Randomised Optimisation Process')
ax.set_xlabel("Number of Rounds Run")
ax.set_ylabel("Best Composite Score Achieved So Far")




# The following is a separate approach that aims to achieve a better score in a more systematic and efficient way.

evenbiggergroup = []
tempdf = df
lentrack = []
groupsize = 20
minimumnumberofcountries = 5
while len(tempdf)>0:
    grouping = []
    diversifiersfound = []

    counter = 0
    for i,r in tempdf.iterrows():
        counter+=1
        print(str(counter).rjust(3), end = '\r')
        if len(grouping)>0:
            if len(diversifiersfound) <= minimumnumberofcountries:
                if r[variable_to_be_diversified] not in diversifiersfound:
                    grouping.append(i)
                    diversifiersfound.append(r[variable_to_be_diversified])
            else:
                grouping.append(i)
        else:
            grouping.append(i)
            diversifiersfound.append(r[variable_to_be_diversified])
        
        if len(grouping)>= minimumnumberofcountries:
            break
            

    evenbiggergroup.append(grouping)
    for i in grouping:
        tempdf = tempdf.drop(i)
    lentrack.append(len(tempdf))
    


goodlist = [i for i in evenbiggergroup if len(i)>4]



tempdf2 = df
tempdf2['Group'] = 0



for j, l in enumerate(goodlist):
    for i in l:
        tempdf2['Group'][i] = j+1



listofindex = tempdf2.index.tolist()
shuffle(listofindex)
for i in list(chain.from_iterable(goodlist)):
    listofindex.remove(i)


def chunk(it, size):
    it = iter(it)
    return list(iter(lambda: tuple(islice(it, size)), ()))



fillinggood = (chunk(listofindex[:len(goodlist)*(groupsize - minimumnumberofcountries)], (groupsize - minimumnumberofcountries)))
fillingbad = (chunk((listofindex[len(goodlist)*(groupsize - minimumnumberofcountries):]), (groupsize)))


for j, l in enumerate(fillinggood):
    for i in l:
        tempdf2['Group'][i] = j+1
        
for j, l in enumerate(fillingbad):
    for i in l:
        tempdf2['Group'][i] = j+1+len(goodlist)


individualscore = [getscore(tempdf2[tempdf2['Group'] == i])[0] for i in range(len(tempdf2)//groupsize)]
individualscorefromdiversity = [getscore(tempdf2[tempdf2['Group'] == i])[1] for i in range(len(tempdf2)//groupsize)]
score2 = np.mean(individualscore) - np.var(individualscorefromdiversity)
print('Composite Score Achieved by the Second Approach: ', score2)



# The two solutions will be compared, the better performing one will become the final dataframe
if score2 >= bestscore:
    bestscore = score2
    finaldf = tempdf2
    
else:
    finaldf = df
    finaldf['Group'] = 0
    for j, l in enumerate(bestconfig):
        for i in l:
            finaldf['Group'][i] = j+1
    
finaldf = finaldf.sort_values(by = 'Group')
    
#finaldf will be output into the app database to become the grouping that users will see

