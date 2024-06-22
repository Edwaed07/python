'''
How to create a simple REST API with Python and Flask in 5 minutes
https://medium.com/duomly-blockchain-online-courses/how-to-create-a-simple-rest-api-with-python-and-flask-in-5-minutes-94bb88f74a23
https://pythonbasics.org/flask-tutorial-routes/
run : pip install flask
Testing :
URL : http://127.0.0.1:8080/api/apple/30
output on browser :
{
  "para1": "apple",
  "para2": "30"
}
'''

from flask import Flask

app = Flask(__name__)

@app.route("/api/<para1>/<para2>")
def process(para1=None, para2=None):
    value = float(raw_value)
    if value.is_integer():
        value = int(value)
    #Mode is not quantity or weight
    if mode not in ['quantity', 'weight']:
        return jsonify({"result": "rejected", "reason": "Error: mode must be 'quantity' or 'weight'"})
    #Quantity mode
    if mode == 'quantity':
        if value > 30:
            #Qty > 30, rejected
            return jsonify({"result": "rejected", "reason": "Maximum number of units per package is 30"})
        #otherwise, calculate the shipping fee
        cost = 300 + (value - 1) * 60
    #Weight mode
    else:
        #weight > 70kg, reject
        if value > 70:
            return jsonify({"result": "rejected", "reason": "Maximum weight per package is 70kg"})
        #otherwise, calculate the shipping fee
        cost = 300 + (max(value - 1, 0) * 50)
    #return the shipping fee with acception
    return jsonify({"result": "accepted", "cost": cost})

if __name__ == "__main__":
    app.run(debug=True,
            host='127.0.0.1',
            port=8080)
