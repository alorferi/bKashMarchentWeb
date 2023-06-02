<form method="get">

    @csrf

    Source: <input type="radio" name="source" value="local"
    @if ($source=="local")
    checked
    @endif
    onclick="this.form.submit()"
    > Local
    <input type="radio" name="source" value="bkash"

    @if ($source=="bkash")
    checked
    @endif
    onclick="this.form.submit()"
    > bKash

</form>
