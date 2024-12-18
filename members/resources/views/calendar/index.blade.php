<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            width: 5.88%;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        td {
            height: 60px;
        }
        .current-month {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>カレンダー - {{ $currentMonth->format('Y年m月') }}
        @if ($kubun == 0)
            前半
　　　　@endif
        @if ($kubun == 1)
            後半
　　　　@endif
    </h1>
    <h2>期間 {{ $startOfMonth2 }} ～ {{ $endOfMonth }} {{ $firstDayOfWeek }}  kubun {{ $kubun }} add {{ $add }}</h2>　
    <!-- 前月、翌月ボタン -->
    <div>
        <a href="{{ route('calendar.index.offset', ['monthOffset' => $monthOffset - 1]) }}">＜＜</a>
        <a href="{{ route('calendar.index.offset', ['monthOffset' => $monthOffset + 1]) }}">＞＞</a>
    </div>

    <table>
        <thead>
	    <tr>
		
		<th>氏名</th>
		@foreach ($daysInMonth as $day)
		    <th>{{ $day->month }}/{{ $day->day }}</th>
		@endforeach
            </tr>
        </thead>
	<tbody>
	    @foreach ($users as $user)
	    <tr>
		<td>{{ $user->name }}</td>
		@foreach ($daysInMonth as $day)
		    <td></td>
		@endforeach
	    </tr>
	    @endforeach
        </tbody>
    </table>
</body>
</html>

