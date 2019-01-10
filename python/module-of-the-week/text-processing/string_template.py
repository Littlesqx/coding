import string

values = {'var': 'foo'}

t = string.Template("""
Variable            : $var
Escape              : $$
Variable in text    : ${var}ibale
""")

print('TEMPLATE:', t.substitute(values))

s = """
Variable            : %(var)s
Escape              : %%
Variable in text    : %(var)siable
"""

print("INTERPOLATION:", s % values)

s = """
Variale             : {var}
Escape              : {{}}
Variable in text    : {var}iable
"""

print('FORMAT:', s.format(**values))