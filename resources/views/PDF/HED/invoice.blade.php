<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="css/invoice.css">
    </head>
    <body>
        <header>
            <img class="company-logo" src="images/company-logo.jpg">
            <h1 class="clear">
                Invoice<br>
                Extended Health and Dental Plan<br>
                Annual Premium
            </h1>
        </header>
        <section class="overview">
            <div class="personal-info">
                <div class="name">
                    {{ $fullName }}
                </div>
                <div class="address">
                    {{ $address1 }}
                    @if($address2)
                        <br>{{ $address2 }}
                    @endif
                </div>
                <div class="location">
                    {{ $city }},
                    {{ $province }}
                    {{ $postalCode }}
                </div>
            </div>

            <div class="invoice-info">
                <table>
                    <tr>
                        <td class="invoice-header">
                            Invoice Date:
                        </td>
                        <td>
                            {{ $invoiceDate }}
                        </td>
                    </tr>
                    <tr>
                        <td class="invoice-header">
                            Invoice No.
                        </td>
                        <td>
                            {{ $invoiceNum }}
                        </td>
                    </tr>
                    <tr>
                        <td class="invoice-header">
                            Membership No.
                        </td>
                        <td>
                            {{ $membershipNum }}
                        </td>
                    </tr>
                    <tr>
                        <td class="invoice-header">
                            Subscriber No.
                        </td>
                        <td>
                            {{ $subscriberNum }}
                        </td>
                    </tr>
                    <tr>
                        <td class="invoice-header">
                            Insurance Period
                        </td>
                        <td>
                            {{ $fiscalStartDate }}
                        </td>
                    </tr>
                    <tr>
                        <td class="invoice-header">
                            To
                        </td>
                        <td>
                            {{ $fiscalEndDate }}
                        </td>
                    </tr>
                </table>
            </div>
        </section>
        <section class="payment-info clear">
            <table class="plan-review">
                <thead>
                    <tr>
                        <th>
                            Extended Health and Dental plan
                        </th>
                        <th>
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $planType }}
                        </td>
                        <td>
                            {{ $amount }}
                        </td>
                    </tr>
                <tbody>
            </table>
            <h2>Payment is due {{ $dueDate }}</h2>
            <p>
                If you choose not to pay this premium, your health insurance will be cancelled
                as of <strong>{{ $dueDate }}</strong>. To rejoin the plan at a later date, you
                will be required to re-apply with satisfactory evidence of good health.
            </p>
            <p>
                Four payment options for your convenience:
            </p>
            <ol class="payment-options">
                <li>
                    <strong>Cheque/MoneyOrder:</strong> Full payment payable to Example Company Inc.
                </li>
                <li>
                    <strong>Online banking:</strong> BMO, CIBC, RBC, ScotiaBank and Desjardins. Select
                    payee "Example Company Inc." and use your membership number for the account number.
                </li>
                <li>
                    <strong>Credit Card:</strong> VISA, MasterCard and American Express are accepted for
                    full and monthly payments. Full payments can be made by logging in to www.examplecompany.com
                    and clicking "Make a payment" in the footer of the site. To setup monthly credit card
                    payments, contact
                    <a href="mailto:exampleemail@example.com">exampleemail@example.com</a> or
                    <a href="mailto:testemail@example.com">testemail@example.com</a>.
                </li>
                <li>
                    <strong>Automatic bank withdrawal:</strong> Fax, e-mail or mail a void cheque with
                    invoice number for full or monthly payments.
                </li>
            </ol>
        </section>
        <p class="please-detach">
            Please detach and return payment arrangements in the enclosed postage-paid return envelope.
        </p>
        <section class="detach">
            <div class="payment-heading">
                <table class="payment-layout">
                    <tr>
                        <td width="50%">
                            <strong>Received from: {{ $fullName }}</strong>
                        </td>
                        <td>
                            <table class="payment-details">
                                <tr>
                                    <td class="invoice-header">
                                        Invoice No.
                                    </td>
                                    <td>
                                        {{ $invoiceNum }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="invoice-header">
                                        Membership No.
                                    </td>
                                    <td>
                                        {{ $membershipNum }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="invoice-header">
                                        Remittance
                                    </td>
                                    <td>
                                        {{ $amount }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <table class="payment-choice">
                <tr>
                    <td class="hseparator">
                        <table class="payment-type">
                            <tr>
                                <td colspan="3">
                                    <strong>Please indicate type of payment</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="cheque">
                                    <div class="square"></div>
                                    Cheque (made payable to Example Company Inc.)
                                </td>
                                <td class="debit">
                                    <div class="square"></div>
                                    Bank debit (attach voided cheque)
                                </td>
                                <td class="credit">
                                    <div class="square"></div>
                                    Credit card (VISA, MasterCard, AMEX)
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="payment-frequency">
                            <tr>
                                <td colspan="2">
                                    <strong>Please indicate payment frequency</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="one-time">
                                    <div class="square"></div>
                                    One full payment
                                </td>
                                <td class="monthly">
                                    <div class="square"></div>
                                    Monthly payment
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table class="cc-info">
                <tr>
                    <td class="prompt" width="1">
                        Credit card #:
                    </td>
                    <td class="input"></td>
                    <td class="prompt" width="1" align="right">
                        Exp: (MM/YY)
                    </td>
                    <td class="input"></td>
                </tr>
                <tr>
                    <td class="prompt" width="1">
                        Name on card:
                    </td>
                    <td class="input" colspan="3"></td>
                </tr>
                <tr>
                    <td class="prompt" width="1">
                        Signature of card holder:
                    </td>
                    <td class="input" colspan="3"></td>
                </tr>
            </table>
        </section>
        <footer>
            <table>
                <tr>
                    <td>
                        25 Lorem Ipsum Lane, Dolor Amit, QX H0H 0H0
                    </td>
                    <td>
                        tel. 123.456.7890
                    </td>
                    <td>
                        fax 123.456.0987
                    </td>
                    <td>
                        www.examplecompany.com
                    </td>
                </tr>
            </table>
        </footer>
    </body>
</html>
