@if(!$preview)
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
@endif
        <style>
            .email-content * {
                font-family: Calibri, sans-serif;
                font-size:11pt;
            }

            .signature strong {
                color: #004700;
            }

            .signature .separator {
                margin: 0.5em 0 1.0em;
                height: 2px;
                border-top: 1px dashed black;
                border-bottom: 1px solid black;
            }

            .contacts td {
                padding-right: 1.0em;
                white-space: nowrap;
            }

            .treaty-people {
                font-size:10pt;
            }

            .email-content {
                max-width:700px;
            }
        </style>
@if(!$preview)
    </head>
    <body>
@endif
        <div class="email-content">
            <p>
                Dear {{ $prefix }} {{ $lastName }},
            </p>
            <p>
                Thank you for payment of your Example Company Inc. Extended Health & Dental Plan
                premium. Please find attached your payment receipt.
            </p>
            <p>
                <strong>Please retain this receipt for use with your T3 form for the taxation year.</strong>
            </p>
            <p>
                If you have any questions regarding your premium payment, please do not hesitate to contact me.
            </p>
            <p>
                Thanks,
            </p>
            <div class="signature">
                <strong>Lorem Ipsum</strong><br>
                Member Benefits Advisor | Example Company Inc.<br>
                She/Her<br><br>
                <strong>P</strong> (123) 456-7890 |
                <strong>F</strong> (123) 456-0987 |
                <strong>E</strong> <a href="mailto:lorem.ipsum@example.com">lorem.ipsum@example.com</a><br>
                25 Lorem Ipsum Lane, Dolor Amit, QX H0H 0H0
                <div class="separator"></div>
                <i class="treaty-people">
                    DNS sits and operates in Mi'kma'ki and Unama'ki, the traditional and unceded territories of
                    the Mi'kmaq. We are all Treaty People.
                </i>
            </div>
        </div>
@if(!$preview)
    </body>
</html>
@endif
