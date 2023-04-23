<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        .contentTable {
            width: 800px;
            border-collapse: collapse;
        }

        .contentTable tr th {
            border: 1px solid #000;
            padding: 10px;
        }

        .contentTable tr td {
            border: 1px solid #000;
            padding: 10px 10px 1rem 10px;
        }
    </style>
</head>
<body>
    @include('reports._header', ['header' => $header, 'title' => $title])

    <table class="contentTable">
        <thead>
            <tr>
                <th>Data</th>
                <th>Conteúdo lecionado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $lesson)
                <tr>
                    <td>{{ $lesson->date }}</td>
                    <td class="content">{{ $lesson->content }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
