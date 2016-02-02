# Globe Api Client

This is [Globe API](http://www.globelabs.com.ph/docs) Client by [BEAR.Sunday](https://github.com/bearsunday/BEAR.Sunday).

## How to use Globe API

1. Create account on [Globe Labs](https://developer.globelabs.com.ph/users/sign_up).
2. Create new app at http://developer.globelabs.com.ph/apps/new
3. Send from phone number that will be subscribed `INFO` to SHORT CODE of the app.
4. Upon receipt of the welcome message, the subscriber needs to reply `YES`
5. After the subscriber replies (`Yes`), the `ACCESS_TOKEN` and the subscriber’s mobile number will be posted to your Redirect URI
6. Add `GLOBE_API_TOKEN = "xxxxxxxx"` on `.env`

See also: http://www.globelabs.com.ph/docs

## Run on console.

```
$ php bootstrap/api.php post "/outbound/{sender_address}/requests?address={subscribed_phone_number}&message={message}"
```

## Run on the built-in web server.

```
$ php -S 0.0.0.0:8080 bootstrap/api.php
$ curl -X POST http://localhost:8080/outbound/{sender_address}/requests -d address={subscribed_phone_number} -d message={message}
```
