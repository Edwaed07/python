<br>
<div style="display: flex; flex-flow: column;">
    <div id="divTotal">
        <div id="shippingOpt">
            <div id="shipping-container">
                <h2>Shipping Option</h2>
                <img src="img/help.png" id="help">
                <div id="shippingDetailBlock">
                    <table>
                        <tr>
                            <th colspan="2">Weight Mode</th>
                        </tr>
                        <tr>
                            <td><b>Initial cost of First 1 kg</b></td>
                            <td>HKD 300</td>
                        </tr>
                        <tr>
                            <td><b>Per 1 kg (starts from the second kg)</b></td>
                            <td>HKD 50</td>
                        </tr>
                        <tr>
                            <td><b>Maximum weight</b></td>
                            <td>70 kg per order</td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <th colspan="2">Quantity Mode</th>
                        </tr>
                        <tr>
                            <td><b>Initial cost of First unit</b></td>
                            <td>HKD 300</td>
                        </tr>
                        <tr>
                            <td><b>Per unit (starts from the second unit)</b></td>
                            <td>HKD 60</td>
                        </tr>
                        <tr>
                            <td><b>Maximum item quantity</b></td>
                            <td>30 units of item per order</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <label for="qty"><input type="radio" name="shipping" id="qty" checked onclick="getDeliveryFee('quantity')">
                Quantity</label>
            <label for="weight"><input type="radio" name="shipping" id="weight" onclick="getDeliveryFee('weight')">
                Weight</label>
        </div>
        <div>
            <p><b>Total Quantity: </b><span id="totalQty"></span></p>
            <p><b>Total Weight: </b><span id="totalWeight"></span></p>
        </div>
        <table id="total-display">
            <tr>
                <th>Subtotal</th>
                <td id="subtotal"></td>
            </tr>
            <tr>
                <th>Delivery Fee</th>
                <td id="deliveryFee"></td>
            </tr>
            <tr>
                <th>Total</th>
                <td id="total"></td>
            </tr>
        </table>
    </div>
    <br><br>
    <button onclick="placeOrder()" class="green">Confirm &#10004;</button>
</div>