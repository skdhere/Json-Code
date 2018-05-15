#!C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe
print("Content-type:text/html\r\n\r\n")

primeNumbers = 2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199

def computeListOfPrimeFactors(x):
   """This function takes an integer and returns a list of it's prime factors"""
	#ensure that the number is greater than or equal to 2
   if (x<2):
        return 0
      
   pf = []
   i=0
   
   while(primeNumbers[i] <= x):
      if (x%primeNumbers[i]==0):
        pf.append(primeNumbers[i])
        x = x//primeNumbers[i]
      else:
        i = i+1
   
   return pf

def convertImproperToMixedFraction(x):
   """This function converts a Mixed Fraction to an Improper Fraction"""
   x[2] = x[0]//x[1]
   x[0] = x[0]%x[1]
   
   return x

def cancelCommonFactors(cpf1, cpf2):
    """This function cancels out the common factors in the numerator and denominator"""
    
    l1 = len(cpf1)
    l2 = len(cpf2)
    i=0
    
    if (l1>l2):
        while i < len(cpf2):
           try:
               found = cpf1.index(cpf2[i])
               del cpf1[found]
               del cpf2[i]
               
           except:
               
               i+=1
    else:
         while i < len(cpf1):
           try:
               found = cpf2.index(cpf1[i])
               del cpf2[found]
               del cpf1[i]
               
           except:
               
               i+=1
       

    return cpf1, cpf2

def convertMixedToImproperFraction(x):
   """This function converts a Mixed Fraction to an Improper Fraction"""
   x[0] = x[2]*x[1]+x[0]
   
   return x

def computeHCF(x, y):
    """ This building block will compute the Highest Common Factor, HCF """

    while(y):
       x, y = y, x % y

    return x


def computeLCM(x, y):
   """This function takes two integers and returns the L.C.M."""

   lcm = (x*y)//computeHCF(x,y)
   return lcm

def multiplyFactors(cpf):
    """ multiplies all the factors to give an integer"""
    
    
    product = 1
    for i in range(len(cpf)):
        product = product * cpf[i]
    
    return product


v1 = [1,4,3] #num den whole
v2 = [4,9,4] #num den whole
tv1 = convertMixedToImproperFraction(v1)
tv2 = convertMixedToImproperFraction(v2)
tv1NUMfactors = computeListOfPrimeFactors(tv1[0])
tv1DEMfactors = computeListOfPrimeFactors(tv1[1])
tv2NUMfactors = computeListOfPrimeFactors(tv2[0])
tv2DEMfactors = computeListOfPrimeFactors(tv2[1])

print("v1 = ",v1,"<br>")
print("v2 = ",v2,"<br>")
# print("%s",finaldata)
print("Convert mixed to Improper for Variable 1 = ",tv1[0:2],"<br>")
print("Convert mixed to Improper for Variable 2 = ",tv2[0:2],"<br>")
print("Prime Factor for numerator for Variable 1 = ",tv1NUMfactors,"<br>")
print("Prime Factor for denominator for Variable 1 = ",tv1DEMfactors,"<br>")
print("Prime Factor for numerator for Variable 2 = ",tv2NUMfactors,"<br>")
print("Prime Factor for denominator for Variable 2 = ",tv2DEMfactors,"<br>")
conNUMfactors = tv1NUMfactors + tv2NUMfactors
conDEMfactors = tv1DEMfactors + tv2DEMfactors
print("Concatenation of numerators (v1 & v2) = ",conNUMfactors,"<br>")
print("Concatenation of denominator (v1 & v2) = ",conDEMfactors,"<br>")
finalNUMfactors, finalDEMfactors = cancelCommonFactors(conNUMfactors, conDEMfactors)
print("Cancel common factors of numerators (v1 & v2) = ",finalNUMfactors,"<br>")
print("Cancel common factors of denominator (v1 & v2) = ",finalDEMfactors,"<br>")
finalNUM =  multiplyFactors( finalNUMfactors)
finalDEM =  multiplyFactors( finalDEMfactors)
print("Multiply factors of numerators (v1 & v2) = ",finalNUM,"<br>")
print("Multiply factors of denominator (v1 & v2) = ",finalDEM,"<br>")
res = [0,1,1]
res[0] = finalNUM
res[1] = finalDEM
result = convertImproperToMixedFraction(res)
print("Final result = ", result)