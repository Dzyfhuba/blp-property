import { Config } from 'ziggy-js'
import { Widget } from './widget'
import type Setting from './setting'

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
    widgets: Widget[]
    setting?: Setting
};
