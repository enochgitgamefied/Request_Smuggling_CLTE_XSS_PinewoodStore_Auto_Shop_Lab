
---

# 🔥 Chaining Vulnerabilities for Account & System Compromise

## Request Smuggling + XSS Full Exploitation Demo

Welcome to the **Request Smuggling CL.TE + XSS PinewoodStore Auto Shop Lab** —
a hands-on Docker-based lab designed to show how **chaining multiple web vulnerabilities** can escalate into full **account takeover and complete system compromise**.

In this lab, you will exploit:

* ✅ HTTP **Request Smuggling (CL.TE variant)**
* ✅ A reflected **Cross-Site Scripting (XSS)** flaw
* ✅ Backend **session handling and cookie trust**

…and **chain them together** to steal other users’ session cookies, even without their interaction — achieving **account compromise** and demonstrating how small bugs can combine into devastating attacks.

---

## 🕵️‍♂️ What You’ll Learn and Demo

In this advanced lab, you’ll walk through:

* Understanding the **Content-Length + Transfer-Encoding mismatch (CL.TE)** request smuggling technique
* Using crafted smuggled requests to bypass frontend/backend sync
* Smuggling a reflected XSS payload inside an innocent-looking request
* Escalating the reflected XSS into an **effective stored XSS** by forcing it to trigger on any authenticated user — even if they never visit the vulnerable page
* Stealing session cookies, hijacking accounts, and demonstrating how the entire system can be compromised by chaining these bugs

This lab gives you a **full attack demo** — from theoretical understanding to live exploitation.

---

## 📦 Repository

GitHub:
[Request\_Smuggling\_CLTE\_XSS\_PinewoodStore\_Auto\_Shop\_Lab](https://github.com/enochgitgamefied/Request_Smuggling_CLTE_XSS_PinewoodStore_Auto_Shop_Lab)

---

## 🏗 How to Clone and Set Up (Docker)

```bash
# Clone the repository
git clone https://github.com/enochgitgamefied/Request_Smuggling_CLTE_XSS_PinewoodStore_Auto_Shop_Lab.git

# Navigate into the lab directory
cd Request_Smuggling_CLTE_XSS_PinewoodStore_Auto_Shop_Lab

# Build the Docker image
docker build -t pinewoodstore-lab .

# Run the Docker container
docker run -d -p 8080:80 --name pinewoodstore-lab pinewoodstore-lab
```

Once running, visit:
👉 **[http://localhost:8080](http://localhost:8080)**

✅ Log in with test accounts provided in the lab
✅ Begin crafting smuggled payloads and setting up the attack

---

## 🎥 Accompanying Full Demo Video

Watch the detailed **YouTube tutorial** where the full chain is explained and demonstrated:

* Lab setup and walkthrough
* Detailed explanation of each vulnerability
* Live demonstration of chaining request smuggling + XSS
* Cookie theft and account takeover exploit
* Summary of how the attack could lead to **complete system compromise**

**YouTube link:** [→ Watch the Full Demo](https://www.youtube.com/your-tutorial-link-here)
*(replace this with the actual link)*

---

## 🔒 Backend Setup Highlights

This lab includes:

* A real backend **user authentication system** with cookies
* A **reflected XSS flaw** that’s normally hard to exploit without user action
* A vulnerability chain that lets you **turn reflected XSS into stored-like XSS**, impacting any logged-in user, even if they never visit the vulnerable page

✅ Exploiting this chain shows how attackers can **steal cookies and compromise accounts** at scale
✅ The lab mimics real-world misconfigurations seen in production environments

---

## ⚠️ Important

* This lab is **for educational and ethical hacking practice only**
* Do **NOT** apply these techniques to systems you do not own or have explicit permission to test
* Make sure your system has Docker installed and sufficient resources

---

