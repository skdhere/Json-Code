#!C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe
def convertMixedToImproperFraction(x):
   """This function converts a Mixed Fraction to an Improper Fraction"""
   x[0] = x[2]*x[1]+x[0]
   
   return x

def displayFractions(v1):
    """ Displays a fraction in Whole Number, Numerator / Denominator format"""
    
    print('                {}                       {}         '.format(v1[0]))
    print('          -------------    X       --------------')
    print('                {}                       {}         '.format(v1[1]))    
    return


v1 = [3,4,3]
tv1 = convertMixedToImproperFraction(v1)
finaldata = displayFractions(tv1)

print(finaldata)