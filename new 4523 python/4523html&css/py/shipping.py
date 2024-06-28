from flask import Flask, jsonify
from flask_cors import CORS, cross_origin

app = Flask(__name__)
CORS(app, resources={r"/*": {"origins": "*"}})

@app.route('/ship_cost_api/<mode>/<raw_value>', methods=['GET'])
@cross_origin()
def ship_cost_api(mode, raw_value):
    try:
        value = float(raw_value)
    except ValueError:
        return jsonify({"result": "rejected", "reason": "Error: raw_value must be a number"}), 400

    if mode not in ['quantity', 'weight']:
        return jsonify({"result": "rejected", "reason": "Error: mode must be 'quantity' or 'weight'"}), 400

    if mode == 'quantity':
        if value > 30:
            return jsonify({"result": "rejected", "reason": "Maximum number of units per package is 30"}), 400
        cost = 300 + (value - 1) * 60
    else:
        if value > 70:
            return jsonify({"result": "rejected", "reason": "Maximum weight per package is 70kg"}), 400
        cost = 300 + (max(value - 1, 0) * 50)

    return jsonify({"result": "accepted", "cost": cost})

if __name__ == '__main__':
    app.run(host='127.0.0.1', port=8080)