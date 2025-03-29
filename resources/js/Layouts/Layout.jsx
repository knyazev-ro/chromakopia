import { usePage } from '@inertiajs/react';
import { MobileLayout } from '@/Layouts/MobileLayout.jsx';
import { ClassicLayout } from '@/Layouts/ClassicLayout.jsx';

export default function Layout({children})
{
    const {layout} = usePage();
    return <>{layout ? <MobileLayout>{children}</MobileLayout> : <ClassicLayout>{children}</ClassicLayout>}</>
}
