<form method="get">

    @csrf

    Source: <input type="radio" name="source" value="local"
    @if ($source=="local")
    checked
    @endif
    > Local
    <input type="radio" name="source" value="bkash"

    @if ($source=="bkash")
    checked
    @endif

    > bKash

    <input type="submit" value="Submit">

</form>
