<!DOCTYPE html>
<html>
<head>
	<title>Product Attributes</title>
</head>
<body>
	<form>
		<label for="sku">SKU:</label>
		<input type="text" id="sku" name="sku"><br>

		<label for="th_name">TH Name:</label>
		<input type="text" id="th_name" name="th_name"><br>

		<label for="en_name">EN Name:</label>
		<input type="text" id="en_name" name="en_name"><br>

		<label for="priority">Priority:</label>
		<input type="number" id="priority" name="priority"><br>

		<label for="top_200">TOP 200:</label>
		<input type="checkbox" id="top_200" name="top_200"><br>

		<label for="sale">SALE:</label>
		<input type="checkbox" id="sale" name="sale"><br>

		<label for="check_by">Check By:</label>
		<input type="text" id="check_by" name="check_by"><br>

		<label for="check_date">Check Date:</label>
		<input type="date" id="check_date" name="check_date"><br>

		<label for="status">Status:</label>
		<select id="status" name="status" >
			<option value="active">Active</option>
			<option value="discontinued">Discontinued</option>
			<option value="out_of_stock">Out of Stock</option>
		</select><br>

		<input type="button" value="Submit" onclick="updateSheetData('CDS10000946', 'PASS_TEST');">
	</form>
</body>
</html>

<script>
function updateSheetData(sku, status) {
        // Load the Google Sheets API client library
        gapi.load('client', start);

        function start() {
            // Initialize the API client library
            gapi.client.init({
            apiKey: 'AIzaSyB0sTxGv1N6vNFfUeij9U6KycrfezZi92U',
            discoveryDocs: ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
            clientId: '514529310578-jkv0lqnhr27jkaec3e0qu292d2ip295g.apps.googleusercontent.com',
            scope: 'https://www.googleapis.com/auth/spreadsheets'
        }).then(function() {
            // Call the Sheets API to update a value in a cell
            var spreadsheetId = '15yMjoMYxKVomcIs9beZvBG6BcwVO4kdzwEd';
            var sheetName = 'original_data';

            var checkDate = new Date().toISOString(); // Replace with the new check date
            var range = sheetName + '!A:F';
            var values = [];
            var request = gapi.client.sheets.spreadsheets.values.get({
                spreadsheetId: spreadsheetId,
                range: range
            });
        request.then(function(response) {
            var data = response.result.values;
            if (data && data.length > 0) {
            // Get the column indexes for the 'status' and 'check_date' columns
            var headerRow = data[0];
            var statusIndex = headerRow.indexOf('status');
            var checkDateIndex = headerRow.indexOf('check_date');
            for (var i = 0; i < data.length; i++) {
                var row = data[i];
                if (row[0] === sku) {
                row[statusIndex] = status; // Set the status value in the 'status' column
                row[checkDateIndex] = checkDate; // Set the check date in the 'check_date' column
                values.push(row);
                break; // Exit the loop once the SKU is found
                }
            }
            var requestBody = {
                range: range,
                values: values,
                majorDimension: 'ROWS'
            };
            var updateRequest = gapi.client.sheets.spreadsheets.values.update({
                spreadsheetId: spreadsheetId,
                range: range,
                valueInputOption: 'USER_ENTERED',
                requestBody: requestBody
            });
            updateRequest.then(function(response) {
                console.log(response.result);
            }, function(reason) {
                console.error('Error: ' + reason.result.error.message);
            });
            } else {
            console.log('No data found.');
            }
        }, function(reason) {
            console.error('Error: ' + reason.result.error.message);
        });
        });
        }

        // Call the updateSheetData() function with the SKU, status, and checkDate values as arguments




}

</script>
