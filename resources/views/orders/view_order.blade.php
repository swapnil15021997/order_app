<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap");
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Open Sans", sans-serif;
      }
      .table_print {
        width: 100%;
        max-width: 90%;
        border: 1px solid #cccccc;
        margin: auto;
        font-family: "Open Sans", sans-serif;
      }

    </style>
  </head>
  <body>
    <div>
      <!-- <div>
        <h1>Karigar issue</h1>
      </div> -->
      <div class="table_print">
        <div style="display: flex; flex-wrap: wrap">
          <div style="width: 100%">
            <div style="padding: 3px; text-align:center">
              <p><b>Sonic Jewellers Limited-2024-25</b></p>
              <p>Company's GSTIN/UIN : <b>24ABDCS4503K1ZG</b></p>
              <p>GIN: U36996GJ2020PLC112753</p>
            </div>
            <!-- <div style="border-top: 1px solid #cccccc; padding: 8px">
              <p>Buyer (Bill to)</p>
              <p><b>Safikul Islam Mallik (South Bhungri) </b></p>
              <p>Rajkot</p>
              <p>Hk</p>
              <p>State Name : 24</p>
            </div> -->
          </div>
          <!-- <div style="width: 100%; border-left: 1px solid #cccccc">
            <div style="display: flex; flex-wrap: wrap">
              <div style="padding: 8px; width: 50%">
                <p>Delivery Note No.</p>
                <p><b>KARI/24-251217</b></p>
              </div>
              <div
                style="border-left: 1px solid #cccccc; padding: 8px; width: 50%"
              >
                <p>Dated</p>
                <p><b>12-oct-24</b></p>
              </div>
              <div
                style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
              ></div>
              <div
                style="
                  border-left: 1px solid #cccccc;
                  padding: 8px;
                  width: 50%;
                  border-top: 1px solid #cccccc;
                "
              >
                <p>Mode/Terms of Payment</p>
              </div>
               <div
                style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
              >
                <p>Reference No & Date</p>
              </div>
              <div
                style="
                  border-left: 1px solid #cccccc;
                  padding: 8px;
                  width: 50%;
                  border-top: 1px solid #cccccc;
                "
              >
                <p>Other References</p>
              </div>
              <div
                style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
              >
                <p>Byus's Order NO.</p>
              </div>
              <div
                style="
                  border-left: 1px solid #cccccc;
                  padding: 8px;
                  width: 50%;
                  border-top: 1px solid #cccccc;
                "
              >
                <p>Dated</p>
              </div>
              <div
                style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
              >
                <p>Dispateli Doc No</p>
              </div>
              <div
                style="
                  border-left: 1px solid #cccccc;
                  padding: 8px;
                  width: 50%;
                  border-top: 1px solid #cccccc;
                "
              ></div>
              <div
                style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
              >
                <p>Dispatched tfritiugh</p>
              </div>
              <div
                style="
                  border-left: 1px solid #cccccc;
                  padding: 8px;
                  width: 50%;
                  border-top: 1px solid #cccccc;
                "
              >
                <p>Destination</p>
              </div>
              <div
                style="padding: 8px; width: 100%; border-top: 1px solid #cccccc"
              >
                <p>Terms of Delivery</p>
              </div> 
            </div>
          </div> -->
        </div>
        <div style="width: 100%; border-top: 1px solid #cccccc;">
            <div style="display: flex; flex-wrap: wrap">
                <div style=" width: 70%; padding: 3px; text-align:center">

                    @if($order['order_type']==1)
                        <p><b>Order Form</b></p>
                    @else
                        <p><b>Repairing Form</b></p>
                    @endif

                </div>
                <div style="width: 30%;">
                    <div style="padding: 3px; text-align:center; border-left: 1px solid #cccccc;">
                      <p><b>QR Code</b></p>
                     
                    </div>
                </div>
            </div>
        </div>
        
        <div
          style="
            border-top: 1px solid #cccccc;
            border-bottom: 1px solid #cccccc;
          "
        >
          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
              "
            >
              <p>Order Number</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 30%;
              "
            >
              <p>{{$order['order_number']}}</p>
            </div>
            <!-- <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 10%;
              "
            >
              <p>Gross Weight</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 10%;
              "
            >
              <p>Quantity</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 10%;
              "
            >
              <p>Order Date</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 20%;
              "
            >
              <p>{{$order['order_date']}}</p>
            </div>
            <!-- <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 14%;
              "
            >
              <p>Amount</p>
            </div> -->
          </div>


          <div
          style="
            border-top: 1px solid #cccccc;
            border-bottom: 1px solid #cccccc;
          "
        >
          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
              "
            >
              <p>Customer Name</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>HSN/SAC</p>
            </div>
           
          </div>


          <div
          style="
            border-top: 1px solid #cccccc;
            border-bottom: 1px solid #cccccc;
          "
        >
          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
           
            border-bottom: 1px solid #cccccc;
          
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
              "
            >
              <p>Customer Phone Number</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>HSN/SAC</p>
            </div>
           
          </div>


          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
              
            border-bottom: 1px solid #cccccc;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
              "
            >
              <p>Customer Address</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>HSN/SAC</p>
            </div>
           
          </div>

          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
              
            border-bottom: 1px solid #cccccc;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
              "
            >
              <p>Item Metal</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>{{$order['items'][0]['item_metal']}}</p>
            </div>
           
          </div>

          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
              
            border-bottom: 1px solid #cccccc;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
              "
            >
              <p>Item Name</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>{{$order['items'][0]['item_name']}}</p>
            </div>
           
          </div>

          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
              
            border-bottom: 1px solid #cccccc;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
                
              "
            >
              <p>Melting</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>{{$order['items'][0]['item_melting']}}</p>
            </div>
           
          </div>

          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
              border-bottom: 1px solid #cccccc;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
                
              "
            >
              <p>Weight</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>{{$order['items'][0]['item_weight']}}</p>
            </div>
           
          </div>

          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
              border-bottom: 1px solid #cccccc;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
                
              "
            >
              <p>Advance Cash Deposit</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>HSN/SAC</p>
            </div>
           
          </div>


          <div
            style="
              display: flex;
              align-items: stretch;
              flex-wrap: nowrap;
              overflow: hidden;
              border-bottom: 1px solid #cccccc;
            "
          >
            <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
              <p>SI No.</p>
            </div> -->
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 35%;
                
              "
            >
              <p>Advance Rate Book</p>
            </div>
            <div
              style="
                padding: 4px;
                border-left: 1px solid #cccccc;
                width: 100%;
                max-width: 60%;
              "
            >
              <p>HSN/SAC</p>
            </div>
           
          </div>
          

          
        </div>
        <div style="margin-top: 32px; padding: 8px">
          <p>Company's GSTIN/UIN : <b>24ABDCS4503K1ZG</b></p>
          <p>Companys PAN : <b>ABDCS450Kk</b></p>
        </div>
        <div
          style="
            display: flex;
            align-items: stretch;
            border-top: 1px solid #cccccc;
          "
        >
            <div style="width: 10%; padding: 8px; border-right: 1px solid #cccccc">
                <p>Item Remark</p>
          </div>
          <div style="width: 40%; padding: 8px">
            <p>Recd. in Good Condition</p>
          </div>
          <div style="width: 50%; padding: 8px; border-left: 1px solid #cccccc">
            <small style="text-align: end; display: block"
              ><b>for Sonic Jewellers Limited-2024-25</b></small
            >
            <div
              style="
                display: flex;
                align-items: stretch;
                justify-content: space-between;
              "
            >
              <div>
                <div style="margin: 36px 0"></div>
                <p>Customer Sign</p>
              </div>
              <div>
                <div style="margin: 36px 0"></div>
                <p>SalesMan Sign</p>
              </div>
              <div>
                <div style="margin: 36px 0"></div>
                <p>Authorized Manager Signatory</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>