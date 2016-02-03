# Globe Api Client

This is [Globe API](http://www.globelabs.com.ph/docs) Client by [BEAR.Sunday](https://github.com/bearsunday/BEAR.Sunday).

## How to use Globe API

1. Create account on [Globe Labs](https://developer.globelabs.com.ph/users/sign_up).
2. Create new app at http://developer.globelabs.com.ph/apps/new
3. Set Redirect URL as `https://example.com/oauth`
4. Send from phone number that will be subscribed `INFO` to SHORT CODE of the app.
5. Upon receipt of the welcome message, the subscriber needs to reply `YES`
6. After the subscriber replies (`Yes`), the `ACCESS_TOKEN` and the subscriber’s mobile number will be posted to your Redirect URI

See also: http://www.globelabs.com.ph/docs

## Run on console.

```
$ php bootstrap/api.php post "/smsmessaging?subscriber={subscribed_phone_number}&address={phone_number_of_destination}&message={message}"
```

## Run on the built-in web server.

```
$ php -S 0.0.0.0:8080 bootstrap/api.php
$ curl -X POST http://localhost:8080/smsmessaging?subscriber={subscribed_phone_number} -d address={phone_number_of_destination} -d message={message}
```
