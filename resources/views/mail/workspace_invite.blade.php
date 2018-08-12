ワークスペース:{{ $workspace->name }}に招待されました。

登録されたメールアドレスに送信をしています。

@if ($account->confirmation_token)
以下のURLから会員情報の入力を行いアクセスしてください。

{{ route('account.confirm', $account->confirmation_token) }}
@else
以下のURLからワークスペースにアクセスしてください。

{{ route('workspaces.show', $workspace->id) }}
@endif


また、当メールに心当たりのない方は破棄していただきますようお願いします。
