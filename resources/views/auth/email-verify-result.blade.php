<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Verifikasi Email - Balanix</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body
	style="margin:0; padding:0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height:100vh;">
	<table width="100%" cellpadding="0" cellspacing="0" style="min-height:100vh;">
		<tr>
			<td align="center" style="padding:40px 20px;">
				<table width="500" cellpadding="0" cellspacing="0"
					style="max-width:500px; background:#ffffff; border-radius:20px; overflow:hidden; box-shadow:0 20px 40px rgba(0,0,0,0.15);">

					<!-- Header -->
					<tr>
						<td align="center" style="padding:40px 30px 20px 30px;">
							<h2 style="margin:0; color:#2d3748; font-size:28px; font-weight:700; letter-spacing:-0.5px;">
								@if ($status === 'success')
									Email Berhasil Diverifikasi 🎉
								@else
									Email Sudah Diverifikasi ✔️
								@endif
							</h2>
						</td>
					</tr>

					<!-- Body -->
					<tr>
						<td style="padding:0 40px 40px 40px; color:#4a5568; line-height:1.6; text-align:center;">
							<p style="margin-bottom:20px; font-size:16px; color:#2d3748; font-weight:600;">
								Halo, <span style="color:#667eea;">{{ $user->name }}</span>! 👋
							</p>

							@if ($status === 'success')
								<p style="margin-bottom:25px; font-size:15px;">
									Terima kasih telah memverifikasi email kamu.
									Akunmu sekarang sudah aktif dan siap digunakan 🚀.
								</p>
							@else
								<p style="margin-bottom:25px; font-size:15px;">
									Email kamu sudah pernah diverifikasi sebelumnya.
									Kamu bisa langsung login ke akunmu 👍.
								</p>
							@endif

							<!-- Button -->
							<div style="text-align:center; margin:40px 0;">
								<a href="/login"
									style="display:inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:#ffffff; padding:14px 30px; border-radius:50px; text-decoration:none; font-weight:700; font-size:15px; letter-spacing:0.5px; box-shadow:0 8px 25px rgba(102, 126, 234, 0.4); transition:all 0.3s ease;">
									👉 Masuk ke Dashboard
								</a>
							</div>
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
								Halaman ini ditampilkan otomatis, mohon jangan membalas.
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>
