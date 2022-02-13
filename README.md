# DNS TRansactional EMail Replacement (TREMR)

A bespoke email tool that ingests csv files with the proper datasets,
then queues up processes to generate PDF files and email them to members.

## Getting Started

Requirements: A local installation of docker desktop should be installed.

Once installed, create a .env file base on .env.example and fill in your details.

Main updates to the .env file will be the `smtp` details in the Mail section. Also, ensure you have the following:

```
WWWGROUP=1000
WWWUSER=1000
```

Once you have updated the .env file, you should be able to get started in the command line.
Navigate to the directory in which this project has been installed and run
`docker-compose up --build` and the containers should spin up locally. Once they're finished, navigate to https://localhost/ in your browser and you should be all set!

## Features

### Send Invoices/Send Reminder Invoices

Navigate to the Send Invoices page (or Send Reminder Invoices), choose
a csv file to upload, then submit. The difference between these two features
is a red paragraph in the email stating they must pay prior to termination.
The PDF attachment is the same in either case.

#### Requirements

The uploader will verify only the headers in the file, and trusts that the file
being uploaded is properly formatted. All of the following headers are required, in any order:

| Header            | Description                                       | Requirements    |
| ----------------- | ------------------------------------------------- | --------------- |
| id                | Member ID                                         | Cannot be empty |
| name              | Full name                                         | Cannot be empty |
| prefix            | Dr./Mr./Mrs. etc.                                 | Cannot be empty |
| last name         | Last name                                         | Cannot be empty |
| email             | Receiving email address                           | Cannot be empty |
| address1          | Mailing address line 1                            | Cannot be empty |
| address2          | Mailing address line 2                            | Can be empty    |
| city              | Mailing address city                              | Cannot be empty |
| province          | Mailing address province                          | Cannot be empty |
| postal code       | Mailing address postal code                       | Cannot be empty |
| incorporation     | Personal incorporation name                       | Can be empty    |
| invoice date      | Date of invoice                                   | Cannot be empty |
| invoice number    | Invoice Number                                    | Cannot be empty |
| subscriber number | Health plan number                                | Cannot be empty |
| fiscal start date | Effective start date of plan                      | Cannot be empty |
| fiscal end date   | Effective end date of plan                        | Cannot be empty |
| plan type         | Family/Senior Single/etc.                         | Cannot be empty |
| amount            | Amount due (exactly as desired to be displayed)   | Cannot be empty |
| due date          | Payment due date                                  | Cannot be empty |
| pdf name          | Desired PDF filename (with out without extension) | Cannot be empty |

### Preview Invoice Email/Preview Reminder Invoice Email

Displays the invoice email template with dummy values placed (PREFIX, LAST NAME,
MEMBER NUMBER, etc.) where the uploaded csv values will be placed.

### Preview Invoice PDF

Displays an example PDF file that will be attached to the invoice email. The
filename will be as supplied in the `pdf name` column of your csv file when attached
to the email. The Invoice PDF is the same in both the Invoice and Reminder Invoice emails.

### Send Receipt

Navigate to the Send Receipts page, choose a csv file to upload, then submit.

#### Requirements

The uploader will verify only the headers in the file, and trusts that the file
being uploaded is properly formatted. All of the following headers are required, in any order:

| Header        | Description                                       | Requirements    |
| ------------- | ------------------------------------------------- | --------------- |
| id            | Member ID                                         | Cannot be empty |
| name          | Full name                                         | Cannot be empty |
| prefix        | Dr./Mr./Mrs. etc.                                 | Cannot be empty |
| last name     | Last name                                         | Cannot be empty |
| email         | Receiving email address                           | Cannot be empty |
| address1      | Mailing address line 1                            | Cannot be empty |
| address2      | Mailing address line 2                            | Can be empty    |
| city          | Mailing address city                              | Cannot be empty |
| province      | Mailing address province                          | Cannot be empty |
| postal code   | Mailing address postal code                       | Cannot be empty |
| incorporation | Personal incorporation name                       | Can be empty    |
| payment date  | Date of payment                                   | Cannot be empty |
| plan type     | Family/Senior Single/etc.                         | Cannot be empty |
| amount        | Amount due (exactly as desired to be displayed)   | Cannot be empty |
| pdf name      | Desired PDF filename (with out without extension) | Cannot be empty |

### Preview Receipt Email

Displays the receipt email template with dummy values placed (PREFIX, LAST NAME,
MEMBER NUMBER, etc.) where the uploaded csv values will be placed.

### Preview Receipt PDF

Displays an example PDF file that will be attached to the receipt email. The
filename will be as supplied in the `pdf name` column of your csv file when attached
to the email.
