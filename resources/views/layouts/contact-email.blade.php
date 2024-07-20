<div class="container mt-4">
  <div class="card">
      <div class="card-header bg-primary text-white">
          <h2>New Contact Form Submission</h2>
      </div>
      <div class="card-body">
          <p><strong>Name:</strong> {{ $name }}</p>
          <p><strong>Email:</strong> {{ $email }}</p>
          <p><strong>Message:</strong></p>
          <p>{!! $messageContent !!}</p>
      </div>
      <div class="card-footer text-muted">
          <p>This email was sent from the contact form on your website.</p>
      </div>
  </div>
</div>