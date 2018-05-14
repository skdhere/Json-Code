""" _____________________________________________ Start of Building Blocks ___________________________________________"""

primeNumbers = 2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199


def convertMixedToImproperFraction(x):
   """This function converts a Mixed Fraction to an Improper Fraction"""
   x[0] = x[2]*x[1]+x[0]
   
   return x

def convertImproperToMixedFraction(x):
   """This function converts a Mixed Fraction to an Improper Fraction"""
   x[2] = x[0]//x[1]
   x[0] = x[0]%x[1]
   
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


def multiplyFactors(cpf):
    """ multiplies all the factors to give an integer"""
    
    
    product = 1
    for i in range(len(cpf)):
        product = product * cpf[i]
    
    return product


""" _____________________________________________ End of Building Blocks ___________________________________________"""



"""______________________________________________ Engine Part______________________________________________________"""

def getInputForTwoMixedFractions():
    """ Get user to input two mixed fractions"""
    
    v1 = [0,1,1]
    v2 = [0,1,1]

    v1[2] = input('enter the whole number value of variable 1:')    
    v1[0] = input('enter the numerator of variable 1:')
    v1[1] = input('enter the denominator of variable 1:')   
    
    v2[2] = input('enter the whole number value of variable 2:')    
    v2[0] = input('enter the numerator of variable 2:')
    v2[1] = input('enter the denominator of variable 2:')   
     
    return v1, v2

def displayMixedFractions(v1, v2):
    """ Displays a fraction in Whole Number, Numerator / Denominator format"""
    
    print('                {}                       {}         '.format(v1[0], v2[0]))
    print('     {}    -------------    X    {} --------------'.format( v1[2],v2[2]))
    print('                {}                       {}         '.format(v1[1], v2[1]))    
    

    
    return

def displaySingleMixedFraction(v1):
    """ Displays a fraction in Whole Number, Numerator / Denominator format"""
    
    print('                {}         '.format(v1[0]))
    print('     {}    -------------   '.format(v1[2]))
    print('                {}         '.format(v1[1]))    
    

    
    return

def displayFractions(v1, v2):
    """ Displays a fraction in Whole Number, Numerator / Denominator format"""
    
    print('                {}                       {}         '.format(v1[0], v2[0]))
    print('          -------------    X       --------------')
    print('                {}                       {}         '.format(v1[1], v2[1]))    
    

    return

def displayFactors(v1NUM, v1DEM, v2NUM, v2DEM):
    """ Displays a fraction in Whole Number, Numerator / Denominator format"""
    
    print('                {}                 {}         '.format(v1NUM, v2NUM))
    print('          -------------    X       --------------')
    print('                {}                 {}         '.format(v1DEM, v2DEM))    
    

    
    return

def displayConcatenatedFactors(v1NUM, v1DEM):
    """ Displays a fraction in Whole Number, Numerator / Denominator format"""
    
    print('               {} '.format(v1NUM))
    print('          ---------------------------')
    print('               {} '.format(v1DEM))    
    

    
    return

def displaySingleFraction(v1NUM, v1DEM):
    """ Displays a fraction in Whole Number, Numerator / Denominator format"""
    
    print('               {} '.format(v1NUM))
    print('          ---------------------------')
    print('               {} '.format(v1DEM))    
    

    
    return

def showSolution(v1, v2):
    """ Show the complete solution for mixed fraction multiplication """
    
    print('Init step\n\n')
    displayMixedFractions(v1, v2)
    
    print('\n\nStep 1: Convert Mixed Fraction to Improper Fraction\n\n')
    tv1 = convertMixedToImproperFraction(v1)
    tv2 = convertMixedToImproperFraction(v2)    
    displayFractions(tv1, tv2)
    
    print('\n\nStep 2: Find Prime Factors of Numerators and Denominators\n\n')
    tv1NUMfactors = computeListOfPrimeFactors(tv1[0])
    tv1DEMfactors = computeListOfPrimeFactors(tv1[1])
    tv2NUMfactors = computeListOfPrimeFactors(tv2[0])
    tv2DEMfactors = computeListOfPrimeFactors(tv2[1])
    displayFactors( tv1NUMfactors, tv1DEMfactors, tv2NUMfactors, tv2DEMfactors)
    
    print('\n\n        Concatenate numerators and Denominators\n\n')
    tv1NUMfactors.extend( tv2NUMfactors)
    tv1DEMfactors.extend( tv2DEMfactors)
    displayConcatenatedFactors( tv1NUMfactors, tv1DEMfactors)
    
    print('\n\n        Cancel common factors\n\n')  
    finalNUMfactors, finalDEMfactors = cancelCommonFactors(tv1NUMfactors, tv1DEMfactors)
    displayConcatenatedFactors( finalNUMfactors, finalDEMfactors)
    
    print('\n\n        Multiply factors\n\n')
    finalNUM =  multiplyFactors( finalNUMfactors)
    finalDEM =  multiplyFactors( finalDEMfactors)
    #print(' final NUM {}    finalDem {}'.format(finalNUM, finalDEM))
    displaySingleFraction(finalNUM, finalDEM)

    print('\n\nStep 3: Convert Improper Fraction to Mixed Fraction\n\n')
    res = [0,1,1]
    res[0] = finalNUM
    res[1] = finalDEM
    result = convertImproperToMixedFraction(res)
    displaySingleMixedFraction(result)

    return





    
def simulationLoop():
    """ The main simulation Loop """
    
    print('Please input two mixed fractions to showcase the solution for finding out their product ')
    
 #   v1, v2 = getInputForTwoMixedFractions()
    v1 = [5,6,2]
    v2 = [1,3,7] 
    
    showSolution(v1, v2)
    
    return


simulationLoop()



Please input two mixed fractions to showcase the solution for finding out their product 
Init step


                5                       1         
     2    -------------    X    7 --------------
                6                       3         


Step 1: Convert Mixed Fraction to Improper Fraction


                17                       22         
          -------------    X       --------------
                6                       3         


Step 2: Find Prime Factors of Numerators and Denominators


                [17]                 [2, 11]         
          -------------    X       --------------
                [2, 3]                 [3]         


        Concatenate numerators and Denominators


               [17, 2, 11] 
          ---------------------------
               [2, 3, 3] 


        Cancel common factors


               [17, 11] 
          ---------------------------
               [3, 3] 


        Multiply factors


               187 
          ---------------------------
               9 


Step 3: Convert Improper Fraction to Mixed Fraction


                7         
     20    -------------   
                9  