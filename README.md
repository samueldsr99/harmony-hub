<p align="center">
    <a href="https://bluepundit.eu" target="_blank"><img src="./logo.png" height="250"></a><br>
</p>

# Harmony Hub

## Configuration

### Envs

- `POSTMARK_TOKEN`
- `FLARE_KEY`
- `SPOTIFY_CLIENT_ID`
- `SPOTIFY_CLIENT_SECRET`
- `SPOTIFY_BASE_URL`
- `SPOTIFY_TOKEN_URL`
- `BACKUP_MAIL_TO_ADDRESS`
- `BACKUP_ARCHIVE_PASSWORD`

- `GOOGLE_DRIVE_CLIENT_ID`
- `GOOGLE_DRIVE_CLIENT_SECRET`
- `GOOGLE_DRIVE_REFRESH_TOKEN`
- `GOOGLE_DRIVE_FOLDER`

## About Harmony Hub

Harmony Hub is a project used for various configurations and integrations. It is developed as part of
the [Modern Web Application 1 - From Idea to MVP](https://harbour.space/computer-science/courses/modern-web-application-1-nico-deblauwe-946)
course at [Harbour.Space University](https://harbour.space/), instructed by [Nico Deblauwe](https://bluepundit.eu).

## Requirements

The project is built using the [TALL stack](https://tallstack.dev/), specifically [Laravel 10](https://laravel.com) for
the backend, with [Tailwind CSS](https://tailwindcss.com/) and [Alpine.js](https://alpinejs.dev/) for the frontend.

## Environment keys

The project uses the following env keys (in addition to standard Laravel keys):

### Postmark

- `POSTMARK_TOKEN` - Postmark API token

### Flare

- `FLARE_KEY` - Flare API key

### Spotify

- `SPOTIFY_CLIENT_ID` - Spotify client ID
- `SPOTIFY_CLIENT_SECRET` - Spotify client secret
- `SPOTIFY_BASE_URL` - Base url for the Spotify API
- `SPOTIFY_TOKEN_URL` - Url to get the Spotify token

### Backup

- `BACKUP_MAIL_TO_ADDRESS` - Email address to send the backup to
- `BACKUP_ARCHIVE_PASSWORD` - Password for the backup archive
- `GOOGLE_DRIVE_CLIENT_ID` - Google Drive client ID
- `GOOGLE_DRIVE_CLIENT_SECRET` - Google Drive client secret
- `GOOGLE_DRIVE_REFRESH_TOKEN` - Google Drive refresh token
- `GOOGLE_DRIVE_FOLDER` - Google Drive folder ID

## Installation instructions

1. Clone the repository:

    ```sh
    git clone https://github.com/ndeblauw/hsdemo.git
    composer install
    ```

2. Create a database and set the credentials in the `.env` file.

3. (Re)generate the tables and seed with dummy data:

    ```sh
    php artisan migrate:fresh --seed
    ```

4. Set the application key:

    ```sh
    php artisan key:generate
    ```

### Development

Ensure a local email testing service (e.g., Helo) is running.

### Production

- Use the **database driver for the queues** and configure a queue worker.
- Set up the scheduler (e.g., cron job) to run the `schedule:run` command every minute.
- The scheduler comes with a **backup service**; configure a remote S3 disk or change the backup location.

## License

This project is for educational purposes only and can be used without limitations in time or by any institution. The
code cannot be used for any other purpose. Please reference the original repository if you use this code.
