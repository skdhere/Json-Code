<?php

$json ='{
  "QType": 1,
  "Qtype_Name": "Multiplication of 2 Mixed fraction",
  "Question": [
    
      {
        "name": "Mixedfraction",
        "Type": "variable", 
        "N": "",
        "D": "",
        "W": ""
      },
      {
        "name": "Multiply",
        "Type": "operator"
      },
      {
        "name": "Mixedfraction",
        "Type": "variable", 
        "N": "",
        "D": "",
        "W": ""
      }
    ],
    
  
  "Solution": [
    {
      "Steps": [
        {
          "Building Blocks name": "Convert Mixed to Improper",
          "Functions": [
            {
              "name": "convertMixedToImproperFraction(v1)",
              "numerator": "n1",
              "Denominator": "d1"
            },
            {
              "name": "convertMixedToImproperFraction(v2)",
              "numerator": "n2",
              "Denominator": "d2"
            }
          ],
          "Variables": [
            {
              "name": "Mixed fraction",
              "Type": "variable", 
              "N": "",
              "D": "",
              "W": ""
            },
            {
              "name": "Multiply",
              "Type": "operator"
            },
            {
              "name": "Mixed fraction",
              "Type": "variable", 
              "N": "",
              "D": "",
              "W": ""
            }
          ]
        },
        {
          "Building Blocks name": "Find the prime factor of num and denom",
          "Functions": [
            {
              "name": "computeListOfPrimeFactors(v1n1)"
            },
            {
              "name": "computeListOfPrimeFactors(v1d1)"
            },
            {
              "name": "computeListOfPrimeFactors(v2n2)"
            },
            {
              "name": "computeListOfPrimeFactors(v2d2)"
            }
          ]
        },
        {
          "Building Blocks name": "Concatenate numerators and Denominators ",
          "Functions": [
            {
              "name": "concatenate(v1n1, v2n2)",
              "cancatenate_result": "nFinal"
            },
            {
              "name": "concatenate(v1d1, v2d2)",
              "cancatenate_result": "dFinal"
            }
          ]
        },
        {
          "Building Blocks name": "Cancel common factors",
          
          "Functions": [
            {
              "name": "cancelCommonFactors(nFinal, dFinal)",
              "nDistinctFactors": "nDistinct",
              "dDistinctFactors": "dDistinct"
            }
          ]
        },
        {
          "Building Blocks name": "Multiply factors",
          "Functions": [
            {
              "name": "multiplyFactors(nDistinct)",
              "multiply_result": "nMultiply"
            },
            {
              "name": "multiplyFactors(dDistinct)",
              "multiply_result": "dMultiply"
            }
          ]
        },
        {
          "Building Blocks name": "Convert Improper Fraction to Mixed Fraction",
          "Functions": [
            {
              "name": "convertImproperToMixedFraction(nMultiply, dMultiply)",
              "final_result": "finalResult"
            }
          ]
        }
      ]
    },
    {
      "Steps": [
        {
          "Building Blocks name": "Convert Mixed to Improper",
          "Functions": [
            {
              "name": "convertMixedToImproperFraction(v1)",
              "numerator": "n1",
              "Denominator": "d1"
            },
            {
              "name": "convertMixedToImproperFraction(v2)",
              "numerator": "n2",
              "Denominator": "d2"
            }
          ]
        },
        {
          "Building Blocks name": "Find the prime factor of num and denom",
          "Functions": [
            {
              "name": "computeListOfPrimeFactors(v1n1)"
            },
            {
              "name": "computeListOfPrimeFactors(v1d1)"
            },
            {
              "name": "computeListOfPrimeFactors(v2n2)"
            },
            {
              "name": "computeListOfPrimeFactors(v2d2)"
            }
          ]
        },
        {
          "Building Blocks name": "Concatenate numerators and Denominators ",
          "Functions": [
            {
              "name": "concatenate(v1n1, v2n2)",
              "cancatenate_result": "nFinal"
            },
            {
              "name": "concatenate(v1d1, v2d2)",
              "cancatenate_result": "dFinal"
            }
          ]
        },
        {
          "Building Blocks name": "Cancel common factors",
          "Functions": [
            {
              "name": "cancelCommonFactors(nFinal, dFinal)",
              "nDistinctFactors": "nDistinct",
              "dDistinctFactors": "dDistinct"
            }
          ]
        },
        {
          "Building Blocks name": "Multiply factors",
          "Functions": [
            {
              "name": "multiplyFactors(nDistinct)",
              "multiply_result": "nMultiply"
            },
            {
              "name": "multiplyFactors(dDistinct)",
              "multiply_result": "dMultiply"
            }
          ]
        }
        
      ]
    }
  ]
}';

echo $json;

?>