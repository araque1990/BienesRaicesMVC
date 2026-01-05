<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin: 0; padding: 0; background-color: #f6f9f2; font-family: Arial, sans-serif;">
    <div style="display: none; max-height: 0px; overflow: hidden;">
        Nuevo mensaje de <?php echo htmlspecialchars($contacto['nombre']); ?>
    </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f6f9f2;">
        <tr>
            <td align="center" style="padding: 10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                    style="max-width: 600px; background-color: #ffffff; border: 1px solid #e1e1e1; border-radius: 8px; overflow: hidden;">

                    <tr>
                        <td align="center" style="background-color: #333333; padding: 30px 20px;">
                            <h1
                                style="color: #FFFFFF; margin: 0; font-size: 22px; text-transform: uppercase; letter-spacing: 2px;">
                                Bienes <span style="color: #e08709;">Raíces</span>
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px;">
                            <h2 style="color: #333333; margin-top: 0; font-size: 20px;">Resumen del Mensaje</h2>

                            <table width="100%" border="0" cellspacing="0" cellpadding="10"
                                style="border: 1px solid #f0f0f0; border-radius: 5px;">
                                <tr>
                                    <td style="padding: 10px; border-bottom: 1px solid #eee;">
                                        <div
                                            style="color: #888888; font-size: 11px; text-transform: uppercase; font-weight: bold;">
                                            Interesado</div>
                                        <div style="color: #333333; font-weight: bold; font-size: 16px;">
                                            <?php echo htmlspecialchars($contacto['nombre']); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border-bottom: 1px solid #eee;">
                                        <div
                                            style="color: #888888; font-size: 11px; text-transform: uppercase; font-weight: bold;">
                                            Operación y Presupuesto</div>
                                        <div style="margin-top: 5px;">
                                            <span
                                                style="background-color: #71b100; color: white; padding: 2px 8px; border-radius: 3px; font-size: 11px; font-weight: bold; vertical-align: middle;">
                                                <?php echo strtoupper(htmlspecialchars($contacto['tipo'])); ?>
                                            </span>
                                            <span
                                                style="color: #e08709; font-weight: bold; font-size: 18px; margin-left: 10px; vertical-align: middle;">
                                                $<?php echo number_format($contacto['precio'], 0, ',', '.'); ?>
                                            </span>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 10px; background-color: #fcfcfc;">
                                        <div
                                            style="color: #888888; font-size: 11px; text-transform: uppercase; font-weight: bold; margin-bottom: 5px;">
                                            Contacto Directo</div>
                                        <div style="font-size: 14px;">
                                            <?php if ($contacto['contacto'] === 'email'): ?>
                                                <a href="mailto:<?php echo $contacto['email']; ?>"
                                                    style="color: #037bc0; text-decoration: none; font-weight: bold;">
                                                    ✉ <?php echo htmlspecialchars($contacto['email']); ?>
                                                </a>
                                            <?php else: ?>
                                                <div style="color: #333; font-weight: bold;">📞
                                                    <?php echo htmlspecialchars($contacto['telefono']); ?>
                                                </div>
                                                <div style="color: #666; font-size: 12px; margin-top: 3px;">📅
                                                    <?php echo htmlspecialchars($contacto['fecha'] . " | " . $contacto['hora']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="margin-top: 20px; padding: 15px; background-color: #fff9f0; border-left: 4px solid #e08709; border-radius: 0 4px 4px 0;">
                                <div
                                    style="font-weight: bold; font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 8px;">
                                    Mensaje:</div>
                                <div style="color: #444; font-style: italic; line-height: 1.5; font-size: 15px;">
                                    "<?php echo nl2br(htmlspecialchars($contacto['mensaje'])); ?>"
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"
                            style="background-color: #f9f9f9; padding: 20px; color: #999999; font-size: 11px; line-height: 1.4;">
                            Este es un mensaje automático.<br>
                            &copy; <?php echo date('Y'); ?> Bienes Raíces.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>