## Webhook

### Create a Webhook

```php
$accountId = "acc_GP4lfNA0iIMn5B";

$api->account->fetch($accountId)->webhooks()->create(array(
    "url" => "https://google.com",
    "alert_email" => "gaurav.kumar@example.com",
    "secret" => "12345",
    "events" => array(
        "payment.authorized",
        "payment.failed",
        "payment.captured",
        "payment.dispute.created",
        "refund.failed",
        "refund.created"
    )
));
```

**Parameters:**

| Name        | Type   | Description                                                                                                                                                                                         |
|-------------|--------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| accountId*  | string | The unique identifier of a sub-merchant account generated by Razorpay.                                                                                                                              |
| url*        | string | The URL where you receive the webhook payload when an event is triggered. The maximum length is 255 characters.                                                                                     |
| alert_email | string | This is the email address to which notifications must be sent in case of webhook failure.                                                                                                           |
| secret      | string | A secret for the webhook endpoint that is used to validate that the webhook is from Razorpay.                                                                                                       |
| events      | string | The required events from the list of Active Events. For example `payment.authorized`, `payment.captured`, `payment.failed`, `payment.dispute.created`, `refund.failed`, `refund.created` and so on. |

**Response:**

```json
{
  "id": "JebiXkKGYwua5L",
  "created_at": 1654605478,
  "updated_at": 1654605478,
  "service": "beta-api-live",
  "owner_id": "JOGUdtKu3dB03d",
  "owner_type": "merchant",
  "context": [],
  "disabled_at": 0,
  "url": "https://google.com",
  "alert_email": "gaurav.kumar@example.com",
  "secret_exists": true,
  "entity": "webhook",
  "active": true,
  "events": [
    "payment.authorized",
    "payment.failed",
    "payment.captured",
    "payment.dispute.created",
    "refund.failed",
    "refund.created"
  ]
}
```

-------------------------------------------------------------------------------------------------------

### Edit Webhook

```php
$accountId = "acc_GP4lfNA0iIMn5B";

$webhookId = "HK890egfiItP3H";

$api->account->fetch($accountId)->webhooks()->edit($webhookId, array(
    "url" => "https://www.linkedin.com",
    "events" => array(
        "refund.created"
    )
));
```

**Parameters:**

| Name       | Type   | Description                                                                                                                                                                                         |
|------------|--------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| accountId* | string | The unique identifier of a sub-merchant account generated by Razorpay.                                                                                                                              |
| webhookId* | string | The unique identifier of the webhook whose details are to be updated                                                                                                                                |
| url        | string | The URL where you receive the webhook payload when an event is triggered. The maximum length is 255 characters.                                                                                     |
| events     | string | The required events from the list of Active Events. For example `payment.authorized`, `payment.captured`, `payment.failed`, `payment.dispute.created`, `refund.failed`, `refund.created` and so on. |

**Response:**

```json
{
  "id": "HK890egfiItP3H",
  "created_at": 1623060358,
  "updated_at": 1623067148,
  "service": "beta-api-test",
  "owner_id": "H3kYHQ635sBwXG",
  "owner_type": "merchant",
  "context": [],
  "disabled_at": 0,
  "url": "https://www.linkedin.com",
  "alert_email": "gaurav.kumar@example.com",
  "secret_exists": true,
  "entity": "webhook",
  "active": true,
  "events": [
    "refund.created"
  ]
}
```

-------------------------------------------------------------------------------------------------------

### Delete an account

```php
$accountId = "acc_GP4lfNA0iIMn5B";

$webhookId = "HK890egfiItP3H";

$api->account->fetch($accountId)->webhooks()->delete($webhookId);

```

**Parameters:**

| Name       | Type   | Description                                                           |
|------------|--------|-----------------------------------------------------------------------|
| accountId* | string | The unique identifier of a sub-merchant account that must be deleted. |
| webhookId* | string | The unique identifier of the webhook whose details are to be updated  |

**Response:**

```json
[]
```

-------------------------------------------------------------------------------------------------------

### Fetch a webhook

```php
$accountId = "acc_GP4lfNA0iIMn5B";

$webhookId = "HK890egfiItP3H";

$api->account->fetch($accountId)->webhooks()->fetch($webhookId);
```

**Parameters:**

| Name       | Type   | Description                                                            |
|------------|--------|------------------------------------------------------------------------|
| accountId* | string | The unique identifier of a sub-merchant account generated by Razorpay. |
| webhookId* | string | The unique identifier of the webhook whose details are to be updated   |

**Response:**

```json
{
  "id": "HK890egfiItP3H",
  "created_at": 1623060358,
  "updated_at": 1623060358,
  "owner_id": "H3kYHQ635sBwXG",
  "owner_type": "merchant",
  "context": [],
  "disabled_at": 0,
  "url": "https://en1mwkqo5ioct.x.pipedream.net",
  "alert_email": "gaurav.kumar@example.com",
  "secret_exists": true,
  "entity": "webhook",
  "active": true,
  "events": [
    "payment.authorized",
    "payment.failed",
    "payment.captured",
    "payment.dispute.created",
    "refund.failed",
    "refund.created"
  ]
}
```

-------------------------------------------------------------------------------------------------------

### Fetch all Webhooks

```php
$accountId = "acc_GP4lfNA0iIMn5B";

$api->account->fetch($accountId)->webhooks()->all();
```

**Parameters:**

| Name       | Type    | Description                                                                                                                                              |
|------------|---------|----------------------------------------------------------------------------------------------------------------------------------------------------------|
| accountId* | string  | The unique identifier of a sub-merchant account generated by Razorpay.                                                                                   |
| from       | integer | Timestamp, in seconds, from when the webhooks are to be fetched.                                                                                         |
| to         | integer | Timestamp, in seconds, till when the webhooks are to be fetched.                                                                                         |
| count      | integer | Number of webhooks to be fetched. The default value is `10` and the maximum value is `100`. This can be used for pagination, in combination with `skip`. |
| skip       | integer | Number of records to be skipped while fetching the webhooks. This can be used for pagination, in combination with `count`.                               |

**Response:**

```json
{
  "id": "HK890egfiItP3H",
  "created_at": 1623060358,
  "updated_at": 1623060358,
  "owner_id": "H3kYHQ635sBwXG",
  "owner_type": "merchant",
  "context": [],
  "disabled_at": 0,
  "url": "https://en1mwkqo5ioct.x.pipedream.net",
  "alert_email": "gaurav.kumar@example.com",
  "secret_exists": true,
  "entity": "webhook",
  "active": true,
  "events": [
    "payment.authorized",
    "payment.failed",
    "payment.captured",
    "payment.dispute.created",
    "refund.failed",
    "refund.created"
  ]
}
```

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/partners/webhooks)**
