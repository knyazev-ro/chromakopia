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
import { PencilIcon } from '@heroicons/react/24/outline'
import { router } from '@inertiajs/react';


export default function AgendaOption({ agenda, option }) {

      const renderVotingSection = (type, option, title, users, icon, color) => {
        const safeUsers = Object.values(users) ?? [];
        
        return (
        <div className='cursor-pointer active:bg-stone-100 transition-colors duration-200 ease-in-out hover:bg-gray-200 py-2 px-4 rounded-md'
        onClick={() => router.post(route('agenda-option.update', option.id), {...option, type:type})}
        >
          <Box sx={{ mb: 3 }}>
            <Typography variant="h6" sx={{ mb: 1, color }}>
              {icon} {title} ({safeUsers.length})
            </Typography>
            {safeUsers.length > 0 ? (
              <List dense>
                {safeUsers.map((user, index) => (
                  <ListItem key={index}>
                    <ListItemAvatar>
                      <Avatar sx={{ bgcolor: `${color}.main` }}>
                        <PersonIcon />
                      </Avatar>
                    </ListItemAvatar>
                    <ListItemText
                      primary={user?.name || 'Неизвестный пользователь'}
                      secondary={user?.email || 'Email не указан'}
                    />
                  </ListItem>
                ))}
              </List>
            ) : (
              <Typography variant="body2" color="text.secondary">
                Нет голосов
              </Typography>
            )}
          </Box>
          </div>
        );
      };
    
      const renderAttachments = (attachments) => {
        const safeAttachments = Array.isArray(attachments) ? attachments : [];
        
        return (
          <Box sx={{ mt: 2 }}>
            <Typography variant="h6" sx={{ mb: 1 }}>
              <LinkIcon /> Вложения ({safeAttachments.length})
            </Typography>
            {safeAttachments.length > 0 ? (
              <ButtonGroup variant="outlined">
                {safeAttachments.map((url, index) => (
                  <Button
                    key={index}
                    component="a"
                    href={url}
                    target="_blank"
                    rel="noopener noreferrer"
                    startIcon={<LinkIcon />}
                  >
                    Вложение {index + 1}
                  </Button>
                ))}
              </ButtonGroup>
            ) : (
              <Typography variant="body2" color="text.secondary">
                Нет вложений
              </Typography>
            )}
          </Box>
        );
      };
    



    return (
        <>
            <Box sx={{ mb: 4 }}>
                {/* Исправленное отображение названия повестки */}
                <Typography variant="h5" gutterBottom>
                    Вопрос дня:{' '}
                    {option?.question || 'Название повестки не указано'}
                </Typography>
                <div className="flex flex-wrap justify-start gap-6">
                    {renderVotingSection(
                        1,
                        option,
                        'Проголосовали ЗА',
                        option?.agreed ?? [],
                        <AgreedIcon color="success" />,
                        'success',
                    )}

                    {renderVotingSection(
                        2,
                        option,
                        'Проголосовали ПРОТИВ',
                        option?.against ?? [],
                        <AgainstIcon color="error" />,
                        'error',
                    )}

                    {renderVotingSection(
                        3,
                        option,
                        'Воздержались',
                        option?.abstained ?? [],
                        <AbstainedIcon color="warning" />,
                        'warning',
                    )}
                </div>

                {renderAttachments(option?.attachments)}
            </Box>
        </>
    );
}
