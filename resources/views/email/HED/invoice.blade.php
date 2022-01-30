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

            .late {
                color: red;
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
            @if ($isLate)
            <p class="late">
                Your health and dental premium payment is due by {{ $dueDate }}. If payment is
                not received by the deadline <strong>your plan will be terminated</strong>.
                Don't delay! After termination, you can only rejoin the plan by providing
                evidence of good health for all applicants.
            </p>
            @endif
            <p>
                Example Company Inc. is proud to be one of the few provincial medical
                associations to provide its members and their families with a comprehensive
                health and dental plan.
            </p>
            <p>
                Your plan includes vision, dental, orthotics, ambulance services, at home nursing
                services, medical equipment, hospital coverage, travel coverage and more.
            </p>
            <p>
                Please find attached your invoice for your annual Example Company Inc. Extended
                Health and Dental plan premium. To avoid disruption in your health insurance,
                payments must be made by <strong>{{ $dueDate }}</strong>.
            </p>
            <p>
                Convenient payment options include:
            </p>
            <p>
                <strong>Credit Card</strong>: You may make a full payment via credit card on our
                <a href="https://example.com/benefits/pay-dues/make-payment">website here</a>.
                If you are interested in setting up monthly payments via credit card, please
                reach out to Lorem or Dolor below.
            </p>
            <p>
                <strong>Cheque</strong>: Full payment can be made via a cheque payable to Example Company Inc.
                Please include the remittance stub from your invoice.
            </p>
            <p>
                <strong>Online banking</strong>: Accepted by Bank of Montreal (BMO), CIBC, RBC,
                ScotiaBank and Desjardins. The account number requested by your bank is your Example
                Company Inc. membership number ({{ $membershipNum }}).
            </p>
            <p>
                <strong>Direct debit</strong>: Payment can be automatically withdrawn from a bank
                account on a monthly or annual basis. Please reach out to Lorem or Dolor below
                to set this up.
            </p>
            <p>
                I'd also like to remind you that your premium cost can be submitted as an expense
                for reimbursement through the Healthcare Spending Account.
            </p>
            <p>
                For more information on Example Company Inc.'s Extended Health and Dental Plan,
                visit <a href="http://www.example.com">www.example.com</a>.
            </p>
            <p>
                If you have any questions or concerns about your invoice, please don't hesitate to
                contact me directly or
            </p>
            <table class="contacts">
                <tr>
                    <td>
                        <strong>Dolor Amet</strong><br>
                        Member Benefits Coordinator<br>
                        (P) (123) 456-8709<br>
                        (E) <a href="mailto:dolor.amet@example.com">dolor.amet@example.com</a>
                    </td>
                    <td>
                        <strong>Lorem Ipsum</strong><br>
                        Member Benefits Coordinator<br>
                        (P) (123) 456-9870<br>
                        (E) <a href="mailto:lorem.ipsum@example.com">lorem.ipsum@example.com</a>

                    </td>
                </tr>
            </table>
            <p>
                Sincerely,
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
