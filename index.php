
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHPMailer Testing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
        <div class="card-body p-4">

            <h4 class="mb-4">Simple PHPMailer Testing</h4>

            <div id="response" class="mt-3"></div>

            <form id="emailForm">

                <div class="mb-3">
                    <label class="form-label">Gmail Username</label>
                    <input type="email" name="gmail_username"
                           class="form-control"
                           placeholder="example@gmail.com" required>
                </div>

                 <div class="mb-3">
                    <label class="form-label">Mail Password (App Password)</label>

                    <div class="input-group">
                        <input type="password"
                            name="mail_password"
                            id="mail_password"
                            placeholder="App password"
                            class="form-control"
                            required>

                        <button class="btn btn-outline-secondary"
                                type="button"
                                id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Display Name</label>
                    <input type="text" name="display_name"
                           placeholder="BANK OF BIRINGAN"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Recipient Email</label>
                    <input type="email" name="email"
                           class="form-control"
                           placeholder="example@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject"
                           class="form-control"
                           placeholder="Test Email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message"
                              class="form-control"
                              rows="4"
                              placeholder="Enter your message..."
                              required></textarea>
                </div>

                <button type="submit" id="sendBtn"
                        class="btn btn-primary w-100">
                    Send Test Email
                </button>

            </form>

          

        </div>
    </div>
</div>

<script src="script.js"></script>
<script src="password.js"></script>
</body>
</html>
