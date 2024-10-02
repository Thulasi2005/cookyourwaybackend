<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        .stats {
            display: flex;
            flex-wrap: wrap; /* Allows wrapping to a new line */
            justify-content: space-between; /* Space between items */
            margin: 20px 0;
        }
        .stat {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #e9ecef;
            text-align: center;
            flex: 1 1 45%; /* Flex-grow, flex-shrink, and base size */
            margin: 10px; /* Add some margin around each stat box */
        }
        .centered {
            text-align: center; /* Center the text */
            margin: 20px 0; /* Add some margin */
        }
        a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
        button {
            padding: 10px 15px;
            color: white;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>

        <div class="stats">
            <div class="stat">
                <h3>Total Users: {{ $totalUsers }}</h3>
            </div>
            <div class="stat">
                <h3>Total Food Makers: {{ $totalFoodMakers }}</h3>
            </div>
            <div class="stat">
                <h3>Total Customers: {{ $totalCustomers }}</h3>
            </div>
            <div class="stat">
                <h3>Total Customized Requests: {{ $totalCustomizedRequests }}</h3>
            </div>
            <div class="stat">
                <h3>Total Cash Payments: {{ $totalCashPayments }}</h3>
            </div>
            <div class="stat">
                <h3>Total Card Payments: {{ $totalCardPayments }}</h3>
            </div>
            <div class="stat">
                <h3>Total Menus: {{ $totalMenus }}</h3>
            </div>
            <div class="stat">
                <h3>Total Revenue: ${{ number_format($totalRevenue, 2) }}</h3> <!-- Format revenue -->
            </div>
        </div>

        <div class="centered">
            <a href="{{ route('admin.users') }}">Manage Users</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;"> <!-- Inline form for better alignment -->
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
