<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Reset Password - Balanix</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body
	style="margin:0; padding:0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height:100vh;">
	<table width="100%" cellpadding="0" cellspacing="0" style="min-height:100vh;">
		<tr>
			<td align="center" style="padding:40px 20px;">
				<table width="500" cellpadding="0" cellspacing="0"
					style="max-width:500px; background:#ffffff; border-radius:20px; overflow:hidden; box-shadow:0 20px 40px rgba(0,0,0,0.15);">

					<!-- Header with Logo -->
					<tr>
						<td align="center" style="padding:40px 30px 20px 30px;">
							<h2 style="margin:0; color:#2d3748; font-size:28px; font-weight:700; letter-spacing:-0.5px;">Reset Password</h2>
						</td>
					</tr>

					<!-- Body Content -->
					<tr>
						<td style="padding:0 40px 40px 40px; color:#4a5568; line-height:1.6;">
							<p style="margin-bottom:20px; font-size:16px; color:#2d3748; font-weight:600;">
								Halo, <span style="color:#667eea;">{{ $user->name }}</span>!
							</p>

							<p style="margin-bottom:25px; font-size:15px;">
								Kami menerima permintaan untuk reset password akun Balanix Anda. Jangan khawatir, kami akan membantu Anda
								mengatur ulang password dengan aman.
							</p>

							<p style="margin-bottom:35px; font-size:15px;">
								Klik tombol di bawah ini untuk melanjutkan proses reset password:
							</p>

							<!-- Reset Button -->
							<div style="text-align:center; margin:40px 0;">
								<a href="{{ $url }}"
									style="display:inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:#ffffff; padding:16px 32px; border-radius:50px; text-decoration:none; font-weight:700; font-size:16px; letter-spacing:0.5px; box-shadow:0 8px 25px rgba(102, 126, 234, 0.4); transition:all 0.3s ease; text-transform:uppercase;">
									🔐 Reset Password Saya
								</a>
							</div>

							<!-- Alternative Link -->
							<div style="background:#f7fafc; border-radius:12px; padding:20px; margin:30px 0; border-left:4px solid #667eea;">
								<p style="margin:0 0 10px 0; font-size:14px; font-weight:600; color:#2d3748;">
									Atau salin link berikut ke browser Anda:
								</p>
								<p style="margin:0; font-size:13px; word-break:break-all; color:#667eea; font-family:monospace;">
									{{ $url }}
								</p>
							</div>

							<!-- Security Info -->
							<div style="background:#fff5f5; border-radius:12px; padding:20px; margin:25px 0; border-left:4px solid #f56565;">
								<p style="margin:0 0 8px 0; font-size:14px; font-weight:600; color:#c53030;">
									⚠️ Penting untuk Keamanan:
								</p>
								<ul style="margin:0; padding-left:18px; font-size:13px; color:#2d3748;">
									<li>Link ini akan kedaluwarsa dalam 60 menit</li>
									<li>Jika Anda tidak meminta reset password, abaikan email ini</li>
									<li>Jangan bagikan link ini kepada siapa pun</li>
								</ul>
							</div>

							<p style="margin-bottom:25px; font-size:14px;">
								Jika Anda mengalami kesulitan, silakan hubungi tim support kami di
								<a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}"
									style="color:#667eea; text-decoration:none; font-weight:600;">{{ env('MAIL_FROM_ADDRESS') }}</a>
							</p>

							<p style="margin-bottom:0; font-size:15px; color:#2d3748;">
								Terima kasih telah menggunakan <strong>Balanix</strong>! 🙏
							</p>
						</td>
					</tr>

					<!-- Footer -->
					<tr>
						<td align="center"
							style="background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%); padding:25px; border-top:1px solid #e2e8f0;">
							<p style="margin:0 0 8px 0; font-size:12px; color:#718096; font-weight:600;">
								&copy; {{ date('Y') }} Balanix. Semua hak dilindungi.
							</p>
							<p style="margin:0; font-size:11px; color:#a0aec0;">
								Email ini dikirim secara otomatis, mohon jangan membalas email ini.
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>
