<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading List App</title>
    <style>
        :root {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --edit: #0284c7;
            --edit-hover: #0369a1;
            --status-to-read-bg: #fef3c7;
            --status-to-read-text: #92400e;
            --status-reading-bg: #dbeafe;
            --status-reading-text: #1e40af;
            --status-finished-bg: #dcfce7;
            --status-finished-text: #166534;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 800px;
        }

        header {
            margin-bottom: 24px;
        }

        header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        header p {
            color: var(--text-muted);
            font-size: 15px;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 18px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: background-color 0.15s ease-in-out, transform 0.05s ease;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-primary {
            background-color: var(--primary);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .btn-edit {
            color: var(--edit);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-edit:hover {
            text-decoration: underline;
            color: var(--edit-hover);
        }

        .btn-danger-link {
            background: none;
            border: none;
            color: var(--danger);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            padding: 0;
        }

        .btn-danger-link:hover {
            text-decoration: underline;
            color: var(--danger-hover);
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-to-read {
            background-color: var(--status-to-read-bg);
            color: var(--status-to-read-text);
        }

        .badge-reading {
            background-color: var(--status-reading-bg);
            color: var(--status-reading-text);
        }

        .badge-finished {
            background-color: var(--status-finished-bg);
            color: var(--status-finished-text);
        }

        .books-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .books-table th {
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
        }

        .books-table td {
            padding: 14px 16px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .books-table tr:last-child td {
            border-bottom: none;
        }

        .book-title {
            font-weight: 600;
            color: var(--text-main);
        }

        .book-author {
            color: var(--text-muted);
        }

        .actions-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: flex-end;
        }

        .empty-state {
            text-align: center;
            padding: 48px 16px;
            color: var(--text-muted);
        }

        .empty-state h3 {
            font-size: 18px;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #334155;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 15px;
            color: var(--text-main);
            background-color: #ffffff;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input[type="text"]:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        .error-message {
            color: var(--danger);
            font-size: 13px;
            margin-top: 5px;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error ul {
            padding-left: 20px;
            margin-top: 4px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .filters {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .filter-link {
            text-decoration: none;
            color: var(--text-muted);
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.15s ease;
        }

        .filter-link:hover {
            color: var(--text-main);
            background-color: #f1f5f9;
        }

        .filter-link.active {
            color: var(--primary);
            background-color: #e0e7ff;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
