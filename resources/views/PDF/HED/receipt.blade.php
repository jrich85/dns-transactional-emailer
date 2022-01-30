<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="css/receipt.css">
    </head>
    <body>
        <header>
            <img class="dns-logo" src="images/company-logo.jpg">
            <br class="clear" />
        </header>
        <section class="overview">
            <div class="personal-info">
                <div class="name">
                    {{ $fullName }}
                </div>
                @if ($personalIncorporation)
                <div class="personal-incorporation">
                    {{ $personalIncorporation }}
                </div>
                @endif
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
        </section>

        <h1>
            OFFICIAL RECEIPT
        </h1>

        <table class="official-receipt">
            <tr>
                <td class="receipt-header">
                    Amount Received:
                </td>
                <td>
                    {{ $amount }}
                </td>
                <td class="receipt-header">
                    Date Received:
                </td>
                <td>
                    {{ $dateReceived }}
                </td>
            </tr>
            <tr>
                <td class="receipt-header">
                    Member No.
                </td>
                <td>
                    {{ $membershipNum }}
                </td>
                <td class="receipt-header">
                    Plan Type:
                </td>
                <td>
                    {{ $planType }}
                </td>
            </tr>
        </table>

        <h1>
            Extended Health and Dental Plan Annual premium<br>
            {{ $fiscalStartDate }} - {{ $fiscalEndDate }}
        </h1>

        <h2>
            Please retain this receipt for use with your T3 form
        </h2>

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
