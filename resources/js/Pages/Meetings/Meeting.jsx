import React from 'react';
import {
  Card,
  CardContent,
  Typography,
  Box,
  Stack,
  Chip,
  Divider,
  List,
  ListItem,
  ListItemAvatar,
  Avatar,
  ListItemText,
  Link,
  ButtonGroup,
  Button
} from '@mui/material';
import {
  CheckCircle as AgreedIcon,
  Block as AgainstIcon,
  PanTool as AbstainedIcon,
  Link as LinkIcon,
  Person as PersonIcon
} from '@mui/icons-material';
import Page from '../Layouts/Page';
import { PencilIcon, TrashIcon } from '@heroicons/react/24/outline'
import { router } from '@inertiajs/react';
import AgendaOption from './AgendaOption';

export default function Meeting({ meeting, agenda })
{
  const formatDate = (dateString) => {
    if (!dateString) return 'Дата не указана';
    const options = {
      day: 'numeric',
      month: 'long',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    };
    return new Date(dateString).toLocaleString('ru-RU', options);
  };

      const agendaOptions = agenda?.agenda_options || {};

      return (
        <Page>
        <Card sx={{ mb: 3, boxShadow: 3 }}>
          <CardContent>
            <div className='flex justify-between w-full px-2 flex-wrap'>
            <Box sx={{ display: 'flex', alignItems: 'center', gap: 2, mb: 3 }}>
              <Typography variant="h4" component="h1">
                {meeting?.name || 'Название собрания не указано'}
              </Typography>
              {meeting?.format_type_label && (
                <Chip 
                  label={meeting.format_type_label}
                  color="primary"
                  variant="outlined"
                />
              )}
            </Box>
            <div className='items-center flex justify-center'>


            <div className='cursor-pointer p-2'
            onClick={() => {
                router.get(route('meetings.edit',  meeting?.id))
            }}
            >
            <PencilIcon className="h-5 w-5 text-gray-500" />
            </div>

            <div className='cursor-pointer p-2'
            onClick={() => {
                router.delete(route('meetings.destroy',  meeting.id))
            }}
            >
            <TrashIcon className="h-5 w-5 text-red-500" />
            </div>
            </div>
            </div>
    
            <Stack spacing={1} sx={{ mb: 3 }}>
              <Typography variant="subtitle1">
                <strong>Дата начала:</strong> {formatDate(meeting?.start_date)}
              </Typography>
              <Typography variant="subtitle1">
                <strong>Дата окончания:</strong> {formatDate(meeting?.end_date)}
              </Typography>
              <Typography variant="subtitle1">
                <strong>Председатель:</strong> {meeting?.chairman?.name || 'Не указан'}
              </Typography>
              <Typography variant="subtitle1">
                <strong>Секретарь:</strong> {meeting?.secretary?.name || 'Не указан'}
              </Typography>
            </Stack>
    
            <Divider sx={{ my: 3 }} />
    
            {
                agendaOptions.map(option => (
                    <AgendaOption option={option} agenda={agenda}/>
                ))
            }
          </CardContent>
        </Card>
        </Page>
      );
    }