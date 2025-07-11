<div class="table-responsive {!! (! $depositedCheques->isEmpty() ? 'panel-scroll' : '')  !!}">
    <table class="table table-hover">
        @forelse($depositedCheques as $depositedCheque)
            <tr>
                <td>{{ $depositedCheque->number }}</td>
                <td>{{ $depositedCheque->date }}</td>
                <td>{{ $depositedCheque->payment->payment_amount }}</td>
                <td>
                    <a href="{{ action('PaymentsController@chequeBounce',['id' => $depositedCheque->payment_id]) }}"
                       class="btn btn-xs btn-danger pull-right margin-left-5">علامت‌گذاری به عنوان برگشتی</a>
                    <a class="btn btn-xs btn-success pull-right"
                       href="{{ action('PaymentsController@clearCheque',['id' => $depositedCheque->payment_id]) }}">علامت‌گذاری به عنوان وصول‌شده</a>
                </td>
            </tr>
        @empty
            <div class="tab-empty-panel font-size-24 color-grey-300">
                داده‌ای موجود نیست
            </div>
        @endforelse
    </table>
</div>

